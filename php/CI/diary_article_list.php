<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 文章管理列表页
 *
 * @author: xiongfusong
 * @date: 2014-05-08
 */
class Diary_article_list extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('ecmall/ecm_diary_article_info_mdl','articleInfo');
        $this->load->model('ecmall/ecm_diary_customer_info_mdl','custInfo');
        $this->load->library('page');
    }

    /**
    * 文章列表页
    *
    */
    function index()
    {
        /*全局初始化变量*/
        $where = array('article_type'=>1);//1.装修日记 2.装修空间
        $order = 'article_releases_time DESC';//按时间倒序
        $field = 'article_id,article_customer_id,article_title,article_releases_time,article_state';
        $where_in = array();
        $where_like = array();//用于模糊查询
        //接收POST数据和页面反显
        $data = $this->_getInput();
        extract($data);//为联合查询准备数据
        $msg = 0;

        //判断有无联合搜索行为
        if(!empty($_POST))
        {
            if(!empty($isverify)) $where['article_state'] = $isverify;
            $customerId = $this->_getCustomerID($nickname);//客户昵称
            if(!empty($nickname))
            {
                $where_in = array(
                    'field'=>'article_customer_id',
                    'values'=>$customerId
                );
            }
            if(!empty($articlename)) $where_like['article_title'] = $articlename;
            $recTotal = $this->articleInfo->getTotalNum($where,$where_in,$where_like);//查询记录总条数
            if(empty($recTotal))
            {
                $msg = 1;
            }
        }

        $limit = 10;//每页显示10条数据
        //分页入参为偏移量
        $offset = !empty($_GET['per_page']) ? $_GET['per_page'] : 0;

        $recTotal = $this->articleInfo->getTotalNum($where,$where_in,$where_like);//查询记录总条数
        $articleList = $this->articleInfo->getTotal($where, $limit, $offset, $order,$where_in,$where_like,$field);//记录列表
        $articleList = $this->_getNickname($articleList);//获得装修客户昵称

        $uri = 'isverify='.$isverify.'&nickname='.$nickname.'&articlename='.$articlename;
        $data['pageinfo'] = $this->_getPagingbar($limit,$uri,$recTotal);

        /*全局输出数据*/
        $data['articleList'] = $articleList;//列表数据
        $data['recTotal'] = $recTotal;//记录总数
        $data['msg'] = $msg;
        $data['admin'] = $this->adminFlag;//权限标识 - 1:管理员，0:编辑
        $data['per_page'] = $offset;

        $this->load->view('diary/diary_article_list.html',$data);
    }

    /**
    * 删除文章
    *
    */
    function delArticle()
    {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;//文章表主键
        $isDel = $this->articleInfo->del($id);
        if($isDel === TRUE)
        {
            $data = $this->_getInput();
            extract($data);
            $perPage = $this->input->get('per_page');
            header('Location:/index.php/diary/diary_article_list?isverify='.$isverify.'&nickname='.$nickname.'&articlename='.$articlename.'&per_page='.$perPage);
        }
        else
        {
            show_error('删除文章操作失败!',200,'Error');
        }
    }

    /**
    * POST/GET公共数据的收集与处理
    *
    */
    protected function _getInput()
    {
        $data['isverify'] = isset($_REQUEST['isverify']) ? $_REQUEST['isverify'] : 0;
        $data['nickname'] = isset($_REQUEST['nickname']) ? $_REQUEST['nickname'] : '';
        $data['articlename'] = isset($_REQUEST['articlename']) ? $_REQUEST['articlename'] : '';
        return $data;
    }

    /**
    * 获取分页工具栏(此函数有待修改)
    *
    * @param - integer - 每页显示的记录条数
    *          string  - 设置分页链接要带入的参数
    *          integer - 查询到的记录总条数
    *          boolean - 控制url参数per_page的含义:1.false时表示偏移量;2.其他任何值时表示当前页码(此法有bug!)
    *
    * @return - string - 分页条html代码
    */
    protected function _getPagingbar($limit=0, $uri='a=a', $total=0, $type=false)
    {
        //分页配置项
        $config = array(
            'per_page'=>$limit,//每页显示的个数
            'base_url'=>'/index.php/diary/diary_article_list?'.$uri,
            'total_rows'=>$total,//查询到的记录总条数
            'use_page_numbers'=>false,
            'cur_tag_open'=>' <span class="paging_ahover">',//当前页开始样式
            'cur_tag_close'=>'</span>',//当前页结束样式
            'prev_link'=>'<span style="margin:0 5px;"><img src="/static/images/button_14.gif" /></span>',//上翻页样式
            'next_link'=>'<span style="margin:0 5px;"><img src="/static/images/button_16.gif" /></span>',//下翻页样式
            'first_link'=>'<span class="paging_home">首页</span>',//跳转首页样式
            'last_link'=>'<span class="paging_last">尾页</span>',//跳转尾页样式
            'num_tag_open'=>'<span class="paging_initial">',
            'num_tag_close'=>'</span>'//每一页样式标签结束
        );
        $this->page->initialize($config);//初始化分页
        $pagingbar = $this->page->create_links();//生成分页条
        $pagingbar = str_replace('&nbsp;','', $pagingbar);
        return $pagingbar;
    }

    /**
    * 根据文章表与客户表关联关系,获取装修客户昵称
    *
    * @param - 二维数组 - 装修文章数据
    * return - 二维数组 - 添加装修客户昵称
    */
    private function _getNickname($arrData)
    {
        foreach($arrData as $k=>$v)
        {
            $res = $this->custInfo->getOne((int)$v['article_customer_id'],'customer_nickname');
            $arrData[$k]['customer_nickname'] = $res['customer_nickname'];
        }
        return $arrData;
    }

    /**
    * 根据客户昵称获取客户表主键
    *
    * @param - string 客户昵称
    * @return - array 客户表主键
    */
    private function _getCustomerID($nickname)
    {
        $order = 'customer_id ASC';
        $where_like = array('customer_nickname'=>$nickname);
        $field = 'customer_id';
        $custInfo = $this->custInfo->getTotal(array(), 0, 0, $order,array(),$where_like,$field);//记录列表
        if(empty($custInfo)) return 0;//未查询到相关信息
        foreach($custInfo as $v)
        {
            $idarr[] = (int)$v['customer_id'];//必须进行强制类型转换
        }
        return $idarr;
    }
}
