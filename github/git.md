#学习git的原理和使用
该文档收集了日常工作中用到的一些git命令，以及GitHub和git相关的网络资料。

##Git命令

###Git远程命令
* [Git远程操作详解](http://www.ruanyifeng.com/blog/2014/06/git_remote.html)
* git push origin master 将本地仓库的修改提交到远程仓库
* git pull origin master 拉取远程仓库

###Git本地命令
* git checkout -b newbranch 新建分支(增)
* git checkout abranch  切换到某个分支
* git branch 查看分支(加 * 表示当前所在分支,查)
* git branch -d tmpbranch  删除临时分支(删)
* git merge tmpbranch  将tmpbranch分支合并到当前所在的分支
* git add 将某个文件纳入版本控制
* git rm 删除本地库的某个文件
* git commit -m "comment" 将更新提交到本地仓库
* git checkout -- filename 恢复对某个文件的修改


##参考资料
* [git简明指南](http://rogerdudler.github.io/git-guide/index.zh.html)
* [git cheatsheet](http://ndpsoftware.com/git-cheatsheet.html#loc=stash)
* [Pro Git](http://git-scm.com/book/zh)
* [git常用命令](http://www.cnblogs.com/1-2-3/archive/2010/07/18/git-commands.html)
* [GitHub秘籍](https://github.com/tiimgreen/github-cheat-sheet/blob/master/README.zh-cn.md)
* [GitHub 丝带](https://github.com/blog/273-github-ribbons)
