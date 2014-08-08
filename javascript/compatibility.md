兼容性
======
setAttribute

option元素在IE6~8没有click事件，给select加onchange事件

IE9以下的版本不支持数组的indexOf()方法

方法一:

```javascript
//for IE
if(!Array.indexOf)
{
    Array.prototype.indexOf = function(obj)
    {
        for(var i=0; i<this.length; i++)
        {
            if(this[i]==obj)
            {
                return i;
            }
        }
        return -1;
    }
}
```

方法二:

```javascript
if (!Array.prototype.indexOf)
{
    Array.prototype.indexOf = function(elt /*, from*/)
    {
        var len = this.length >>> 0;

        var from = Number(arguments[1]) || 0;
        from = (from < 0) ? Math.ceil(from) : Math.floor(from);
        if (from < 0) from += len;
        for (; from < len; from++)
        {
            if (from in this && this[from] === elt) return from;
        }
        return -1;
    };
}
```
