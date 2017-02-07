1. 关于滚动

```javascript
//判断是否滚动到底部
const isBottom = (window.innerHeight + window.scrollY) >= document.body.offsetHeight
```

[![](http://images2015.cnblogs.com/blog/746158/201512/746158-20151203115003627-328900020.png)](http://www.cnblogs.com/xxcanghai/p/5015712.html '来源')

2. js动态设置Select中Option选中

```javascript
/**
 * 设置select选中
 * @param selectId select的id值
 * @param checkValue 选中option的值
 * @link http://fanshuyao.iteye.com/blog/1986616
*/
function setSelectChecked(selectId, checkValue){
  var select = document.getElementById(selectId);
  for(var i=0; i<select.options.length; i++){
    if(select.options[i].value == checkValue){
      select.options[i].selected = true;
      break;
    }
  }
};
```
