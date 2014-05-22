_ _ _
#markdown 语法

##代码区域语法
1) 行内代码  
```
`行内代码`
```
效果:   `行内代码`

2) 代码块  
表示方法:1.每行文字前加4个空格(`空格式`)或1个文本缩进(`缩进式`);2.用3个反单引号```` ``` ````包含(`围栏式`)

    ```
    /*
    * 输出数组的键值对
    */
    function getKV($arr)
    {
        foreach($arr as $k=>$v)
        {
            echo $k.'--'.$v.'<br/>';
        }
    }
    getKV($array('a','b','c'));//函数调用
    ```

着色前效果:

```
/*
* 输出数组的键值对
*/
function getKV($arr)
{
    foreach($arr as $k=>$v)
    {
        echo $k.'--'.$v.'<br/>';
    }
}
getKV($array('a','b','c'));//函数调用
```

语法着色([语言标识符查询](https://github.com/github/linguist/blob/master/lib/linguist/languages.yml))

    ```php
    /*
    * 输出数组的键值对
    */
    function getKV($arr)
    {
        foreach($arr as $k=>$v)
        {
            echo $k.'--'.$v.'<br/>';
        }
    }
    getKV($array('a','b','c'));//函数调用
    ```

着色后的效果:

```php
/*
* 输出数组的键值对
*/
function getKV($arr)
{
    foreach($arr as $k=>$v)
    {
        echo $k.'--'.$v.'<br/>';
    }
}
getKV($array('a','b','c'));//函数调用
```

##表格语法
表格代码:

    |col1 |col2 | col3
    |-----|-----|-----
    | a   |  b  |  c
    | f   |  e  |  d
    | g   |  h  |  i
    | g   |  h  |  i

隔行换色效果:

col1 |col2 | col3
-----|-----|-----
 a   |  b  |  c
 f   |  e  |  d
 g   |  h  |  i
 g   |  h  |  i

##AtX式标题

    #1号标题
    ##2号标题
    ###3号标题
    ####4号标题
    #####5号标题
    ######6号标题

标题效果:

#1号标题
##2号标题
###3号标题
####4号标题
#####5号标题
######6号标题

##列表
1) 无序列表的三种表示方法
```
* 表示普通列表
+ 表示嵌套列表外层
- 表示嵌套列表内层
+ 表示外层列表
    - 表示内层列表
    - 表示内层列表
    - 表示内层列表
```
显示效果:
* `*`+`空格`表示普通列表
+ `+`+`空格`表示嵌套列表外层
- `-`+`空格`表示嵌套列表内层
+ `+`+`空格`表示外层列表
    - `-`+`空格`表示内层列表
    - `-`+`空格`表示内层列表
    - `-`+`空格`表示内层列表

2)有序列表
* 格式:`0~9的数字`+`.`+`空格`+`列表内容`+`尾随两空格`

显示效果:

1. 这是有序列表  
2. 这是有序列表  
3. 这是有序列表  

##分隔符
格式:

3个`*`表示:`***`  
3个`-`表示:`---`  
3个`_`表示:`___`  

效果如下:  
3个`*`表示:

***

3个`-`表示:

---

3个`_`表示:

___

##强调
1)斜体(em)

    _这是斜体_
    *这也是斜体*

渲染效果:

_这是斜体_  
*这也是斜体*

2)加粗(strong)

    __这是加粗__
    **这也是加粗**

渲染效果:

__这是加粗__  
**这也是加粗**

##引用(blockquote)
example 1

    > This is a blockquote with two paragraphs. Lorem ipsum dolor sit amet,
    > consectetuer adipiscing elit. Aliquam hendrerit mi posuere lectus.
    > Vestibulum enim wisi, viverra nec, fringilla in, laoreet vitae, risus.
    >
    > Donec sit amet nisl. Aliquam semper ipsum sit amet velit. Suspendisse
    > id sem consectetuer libero luctus adipiscing.

example 2

    > This is a blockquote with two paragraphs. Lorem ipsum dolor sit amet,
    consectetuer adipiscing elit. Aliquam hendrerit mi posuere lectus.
    Vestibulum enim wisi, viverra nec, fringilla in, laoreet vitae, risus.

    > Donec sit amet nisl. Aliquam semper ipsum sit amet velit. Suspendisse
    id sem consectetuer libero luctus adipiscing.

example 3

    > This is the first level of quoting.
    >
    > > This is nested blockquote.
    >
    > Back to the first level.

example 4

    > ## This is a header.
    >
    > 1.   This is the first list item.
    > 2.   This is the second list item.
    >
    > Here's some example code:
    >
    >     return shell_exec("echo $input | $markdown_script");

渲染效果:

example 1

> This is a blockquote with two paragraphs. Lorem ipsum dolor sit amet,
> consectetuer adipiscing elit. Aliquam hendrerit mi posuere lectus.
> Vestibulum enim wisi, viverra nec, fringilla in, laoreet vitae, risus.
>
> Donec sit amet nisl. Aliquam semper ipsum sit amet velit. Suspendisse
> id sem consectetuer libero luctus adipiscing.

example 2

> This is a blockquote with two paragraphs. Lorem ipsum dolor sit amet,
consectetuer adipiscing elit. Aliquam hendrerit mi posuere lectus.
Vestibulum enim wisi, viverra nec, fringilla in, laoreet vitae, risus.

> Donec sit amet nisl. Aliquam semper ipsum sit amet velit. Suspendisse
id sem consectetuer libero luctus adipiscing.

example 3

> This is the first level of quoting.
>
> > This is nested blockquote.
>
> Back to the first level.

example 4

> ## This is a header.
>
> 1.   This is the first list item.
> 2.   This is the second list item.
>
> Here's some example code:
>
>     return shell_exec("echo $input | $markdown_script");

##任务清单
语法

    - [x] 支持 @提到某人、#引用、[链接]()、**格式化** 和 <del>标签</del> 等语法
    - [x] 需要使用列表语法来激活（无序或有序列表均可）
    - [x] 这是一个已完成项目
    - [ ] 这是一个未完成项目

渲染效果:

- [x] 支持 @提到某人、#引用、[链接]()、**格式化** 和 <del>标签</del> 等语法
- [x] 需要使用列表语法来激活（无序或有序列表均可）
- [x] 这是一个已完成项目
- [ ] 这是一个未完成项目

##参考文献
* [书写博客的神器](http://upwith.me/?p=503)
* [markdown语法说明](http://wowubuntu.com/markdown/)
* [markdown代码及效果](http://www.ituring.com.cn/article/23)
* [Markdown语法说明（详解版）][1]
* [GitHub 风格的 Markdown 语法][2]

[1]:http://www.ituring.com.cn/article/504
[2]:https://github.com/cssmagic/blog/issues/13

_ _ _
