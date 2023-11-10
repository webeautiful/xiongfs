#### 让spider访问ssr, 用户访问spa

```
# 定义蜘蛛和普通用户的标志位
map $http_user_agent $is_spider {
    default 0;
    ~*spider|bot 1;
}
server {
    listen 80;
    server_name your_domain.com;
    location / {
        # 根据 $is_spider 的值判断是蜘蛛还是普通用户
        if ($is_spider) {
            # 蜘蛛访问，返回 SSR 版本
            proxy_pass http://ssr_backend;
        }
        # 普通用户访问，返回 SPA 版本
        try_files $uri $uri/ /index.html =404;
    }
    # 其他服务器配置...
}
```