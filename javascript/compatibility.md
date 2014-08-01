兼容性
======
setAttribute

option元素在IE6~8没有click事件，给select加onchange事件

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

