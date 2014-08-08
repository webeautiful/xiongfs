兼容性
======
setAttribute

一. option元素在IE6~8没有click事件，给select加onchange事件

二. IE9以下的版本不支持数组的indexOf()方法

方法1:

```javascript
//for IE
if(!Array.prototype.indexOf)
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

方法2:

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

三. 浏览器不支持string对象的trim方法时,给内置String函数的prototype扩展一个trim方法:
```javascript
if(typeof String.prototype.trim == 'undefined')
{
    String.prototype.trim = function()
    {
        return this.replace(/^\s\s*/,'').replace(/\s\s*$/,'');
        //return this.replace(/^\s+|\s+$/g, '');
    }
}
```
