<?php
/**
* 数据打通 -关联云平台商品
*
* @author - xiongfusong
* @date - 2014-06-11
*/
class Data_goods_yun_product_select extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('ecmall/ecm_store_mdl','store');
        $this->load->model('ecmall/ecm_goods_mdl','goods');
        $this->load->model('ecmall/mall_store_yun_merchant_relation_mdl','smRelation');
        $this->load->library('switchdb');
        $this->load->model('ljyun/offer_mdl','offer');
        $this->load->model('ljyun/product_mdl','product');
        $this->load->model('ljyun/product_type_mdl','pCate');
        $this->load->model('ecmall/mall_goods_yun_product_relation_mdl','gpRelation');
        $this->load->helper('self');
    }
    // ------------------------------------------------------------------------
    function index()
    {
        $data = $this->_getInput();
        extract($data);
        //商城店铺
        $data['storeName'] = $this->store->getOne($storeId,'store_name');
        //商城店铺关联的云商户编号
        $data['merchantId'] = $this->smRelation->getTotal(array('store_id'=>$storeId,'is_renting'=>1),0,0,'relation_id ASC',array(),array(),'ljyun_id');
        if($yunId === '')
        {
            //默认显示第一个商户的在售商品信息
            $yunId = $data['merchantId'][0]['ljyun_id'];
        }
        if($flag === 2)
        {
            //商城商品名
            $data['goods'] = $this->goods->getOne($goodsId,'goods_name');
        }
        //切换到私有库
        $this->db = $this->switchdb->connectLjyun($yunId);
        if($pType == 2)
        {
            echo '配件';exit;
        }
        elseif($pType == 3)
        {
            echo '材料';exit;
        }
        else
        {
            //在售的标准商品
            $where = 'rcd.offer_verify = 2 ';
            if($pName != '')
            {
                $where .= 'AND pro.product_name LIKE "%'.$pName.'%" ';
            }
            if($pModel != '')
            {
                $where .= 'AND pro.product_model LIKE "%'.$pModel.'%"';
            }
            $limit = 10;
            $offsetLimit = $offset.','.$limit;
            $list = $this->offer->recAll($where,$offsetLimit,'offer_id DESC');
            $data['total'] = $this->offer->recTotal($where);//查询到的在售商品总记录数
            $data['list'] = $this->_preProcess($list,$flag);
            unset($list);
        }
        //分页
        $baseUrl = '/index.php/data/data_goods_yun_product_select?';
        $data['uriSeg'] = $comUri.'&yunid='.$yunId.'&ptype='.$pType.'&pname='.$pName.'&pmodel='.$pModel;
        $data['pageInfo'] = getPagingbar($limit,$baseUrl,$data['uriSeg'],$data['total'],false,'offset');

        $this->load->view('data/data_goods_yun_product_select.html',$data);
    }
    // ------------------------------------------------------------------------
    protected function _getInput()
    {
        //标志符:1.添加时  2.关联时
        $data['flag'] = intval($this->input->get('flag'));
        $data['storeId'] = intval($this->input->get('sid'));
        $data['smrId'] = $this->input->get('rid');
        $data['comUri'] = 'flag='.$data['flag'].'&sid='.$data['storeId'];
        if($data['flag'] === 2)
        {
            $ret['goodsname'] = $this->input->get('goodsname');
            $ret['goodsstate'] = $this->input->get('goodsstate');
            $ret['isrelation'] = $this->input->get('isrelation');
            $ret['perPage'] = $this->input->get('per_page');
            $data['goodsId'] = intval($this->input->get('gid'));
            //原样返回需要的数据
            $data['uri'] = 'rid='.$data['smrId'].'&goodsname='.$ret['goodsname'].'&goodsstate='.$ret['goodsstate'].'&isrelation='.$ret['isrelation'].'&per_page='.$ret['perPage'];
            $data['comUri'] .= '&gid='.$data['goodsId'].'&'.$data['uri'];
            unset($ret);
        }
        else
        {
            $data['comUri'] .= '&rid='.$data['smrId'];
        }
        $data['yunId'] = ($this->input->get_post('yunid') !== false) ? $this->input->get_post('yunid') : '';
        //标识符：1.标准 2.配件 3.材料
        $data['pType'] = ($this->input->get_post('ptype') !== false) ? $this->input->get_post('ptype') : '1';
        $data['pName'] = ($this->input->get_post('pname') !== false) ? trim($this->input->get_post('pname')) : '';
        $data['pModel'] = ($this->input->get_post('pmodel') !== false) ? trim($this->input->get_post('pmodel')) : '';
        $data['offset'] = ($this->input->get('offset') !== false) ? intval($this->input->get('offset')) : 0;
        return $data;
    }
    // ------------------------------------------------------------------------
    /*
    * 标准商品 - 列表输出前预处理
    *
    * @array - $list offer表数据
    * @int - $flag   标识符:1.添加时 2.关联时
    */
    private function _preProcess($list,$flag)
    {
        foreach($list as $k=>$v)
        {
            //分类
            $list[$k]['pt_name'] = $this->_recursive($v['product_typeid'],'',$flag);
        }
        return $list;
    }
    // ------------------------------------------------------------------------
    /*
    * 递归分类名
    *
    * @int - $typeId 分类表主键
    * @string - $return 返回值初始化
    * @int - $flag - 标识符:1.添加时 2.关联时;控制分类排列的格式
    */
    private function _recursive($typeId,$return='',$flag)
    {
        $cate = $this->pCate->getOne(intval($typeId),'pt_fid,pt_name');
        if($cate['pt_fid'] == 0)
        {
//            if($flag === 1)
//            {
//                $return = trim($cate['pt_name'].'|'.$return,'|');
//            }
//            else
//            {
                $return = trim($cate['pt_name'].'<br />'.$return,'<br />');
//            }
            return $return;
        }
        else
        {
//            if($flag === 1)
//            {
//                $return = $cate['pt_name'].'|'.$return;
//            }
//            else
//            {
                $return = $cate['pt_name'].'<br />'.$return;
//            }
            return $this->_recursive($cate['pt_fid'],$return,$flag);
        }
    }
    // ------------------------------------------------------------------------
    /*
    * 操作栏 - 选择
    *
    */
    function select()
    {
        extract($this->_getInput());

        $productId = intval($this->input->get('pid'));//商品id
        $productModel = urldecode($this->input->get('pmdl'));//型号
        //切换到db_mall
        $this->db = $this->switchdb->mall();
        //判断该云平台商品是否已挂接商城商品
        $where = array(
            'ljyun_product_id'=>$productId,
            'ljyun_product_model'=>$productModel,
            'ljyun_id'=>$yunId
        );
        $state = $this->gpRelation->getTotalNum($where);
        if($state === 0)
        {
            if($pType == 2)
            {
                echo '配件';exit;
            }
            elseif($pType == 3)
            {
                echo '材料';exit;
            }
            else
            {
                if($flag === 2)
                {
                    //商品关系表插入一条记录
                    $data = array(
                        'store_id'=>$storeId,
                        'goods_id'=>$goodsId,
                        'ljyun_product_id'=>$productId,
                        'ljyun_product_model'=>$productModel,
                        'ljyun_id'=>$yunId,
                        'type_id'=>1,
                        'add_user'=>$this->session->userdata('username'),
                        'add_time'=>date("Y-m-d H:i:s",time())
                    );
                    $bool = $this->gpRelation->insert($data);
                    //商城商品关联状态置为1
                    if($bool)
                    {
                        $this->goods->update($goodsId,array('is_relation'=>1));
                    }
                    //返回商城商品页
                    $msg['state'] = 1;
                    $msg['content'] = '操作成功';
                    $url = '/index.php/data/data_goods_list?rid='.$smrId;
                }
                else
                {
                    //添加时,跳转到选择图片组页面
                    header('Location:/index.php/data/data_goods_img_chose?'.$comUri.'&yunid='.$yunId.'&pid='.$productId.'&ptype=1&pname='.$pName.'&pmodel='.$pModel.'&offset='.$offset);
                    exit;
                }
            }
        }
        else
        {
            //返回关联云平台商品页
            $msg['state'] = 0;
            $msg['content'] = '该云平台商品已被挂接，请确认';
            $url = '/index.php/data/data_goods_yun_product_select?'.$comUri.'&yunid='.$yunId.'&ptype='.$pType;
        }
        page_message($msg,$url);
    }
}
?>
