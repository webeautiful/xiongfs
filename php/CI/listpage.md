#周五分享会  2014-05-16
* 列表页开发总结
* validate的使用

##列表页开发总结

####get/post参数的接收

    /**
    * POST/GET公共请求的预处理
    *
    */
    protected function _getInput()
    {
        $data['perPage'] = isset($_GET['per_page']) ? intval($_GET['per_page']) : 0;//偏移量
        $data['tagname'] = isset($_REQUEST['tagname']) ? $_REQUEST['tagname'] : '';//标签名
        $data['cateid'] = isset($_REQUEST['cateid']) ? (int)$_REQUEST['cateid'] : 0;//标签分类id
        return $data;
    }

这样做的好处:
* 遵循从哪来回哪去的开发原则(如:修改页返回,修改页保存失败)
* 复用性好

####model的调用(主程序部分)

1. 总记录数
2. 当前页的数据
`$this->model->getTotalNum($where=array(),$where_in=array(),$where_like=array())`
`$this->model->getTotal($where=array(), $limit=0, $offset=0, $order='',$where_in=array(),$where_like=array(),$field="*",$where_not_in=array())`

####分页条的使用(需手动加载分页类Page.php)

    /**
    * 获取分页工具栏
    *
    * @param
    * - $limit - integer - 每页显示的记录条数
    * - $baseUrl - string  - 设置分页链接访问路径(格式:http://example.com?)
    * - $uri - string  - 设置分页链接要带入的参数
    * - $total - integer - 查询到的记录总条数
    *
    * @return - string - 分页条html代码
    */
    protected function _getPagingbar($limit=0, $baseUrl, $uri='a=a', $total=0)
    {
        //分页配置项
        $config = array(
            'per_page'=>$limit,//每页显示的个数
            'base_url'=>$baseUrl.$uri,
            'total_rows'=>$total,//查询到的记录总条数
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

###注意事项

####'删除'前的处理

######有分页时,删除最后一条记录

    /*
    * 判断分页的最后一页是否只有一条记录
    * @notice:处理在有'删除'操作的列表页,有分页且当前页仅有一条数据时,删除该条数据后会出现空白页的问题
    *
    * @param
    * - $limit - 规定每页显示的记录数
    * - $curRecords - 当前页的实际记录数
    * - $totalRecords - 符合条件的记录总数
    *
    *
    */
    protected function _isOnlyRecord($limit=0,$curRecords=0,$totalRecords=0)
    {
        $isOnly = 0;
        if($totalRecords > $limit && $curRecords == 1)
        {
            $isOnly = 1;//表示分页的尾页有且仅有一条数据
        }
        return $isOnly;
    }

######个性化的处理(是否与其他表有关联关系)
标签列表页源码

    /*
    * 判断标签是否已被使用
    * @notice:用于删除操作前的验证
    *
    *@param - $records - 二维数组 当前页查询到的记录
    *@return - 二维数组 分类表记录添加挂接状态字段:0.没有挂接标签; 1.挂接有标签
    */
    private function _isUsed($records)
    {
        foreach($records as $k=>$v)
        {
            $data = array(
                'customer_decorate_style'=>$v['tag_id'],//装修风格
                'customer_decorate_room'=>$v['tag_id'],//户型
                'customer_decorate_budget'=>$v['tag_id'],//预算
                'customer_decorate_area'=>$v['tag_id'],//面积
                'customer_decorate_space'=>$v['tag_id']//空间
            );
            //根据分类主键,查挂接的标签
            foreach($data as $key=>$val)
            {
                $totalNum = $this->custInfo->getTotalNum(array($key=>intval($val)));
                if(!empty($totalNum)) break;
            }
            if(!empty($totalNum))
            {
                $records[$k]['isUsed'] = 1;//标签正被使用
            }else
            {
                $records[$k]['isUsed'] = 0;//标签尚未使用
            }
        }
        return $records;
    }

分类列表页源码

    /*
    * 判断分类是否已挂接标签
    *
    *@param - 二维数组 分类表记录
    *@return - 二维数组 分类表记录添加挂接状态字段:0.没有挂接标签; 1.挂接有标签
    */
    private function _isHoldTag($records)
    {
        foreach($records as $k=>$v)
        {
            //根据分类主键,查挂接的标签
            $totalNum = $this->tagInfo->getTotalNum(array('tag_type_id'=>(int)$v['tag_type_id']));
            if(!empty($totalNum))
            {
                $records[$k]['hold_state'] = 1;
            }else
            {
                $records[$k]['hold_state'] = 0;
            }
        }
        return $records;
    }
