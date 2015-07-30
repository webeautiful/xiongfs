#学习git的原理和使用
该文档收集了日常工作中用到的一些git命令，以及GitHub和git相关的网络资料。

##Git命令
概念: 存档库(Stash), 工作区(Workspace,Index), 暂存区(索引,Index), 本地版本库(Local Repository), 上游版本库(Upstream Repository)

![](http://image.beekka.com/blog/2014/bg2014061202.jpg "git远程工作原理")

###Git远程命令

* [Git远程操作详解](http://www.ruanyifeng.com/blog/2014/06/git_remote.html)
* git push origin master 将`本地仓库(Local Repository)`的修改提交到`远程仓库(Upstream Repository)`
* git pull origin master 拉取远程仓库

###Git本地命令
* git checkout -b newbranch 新建分支(增)
* git checkout abranch  切换到某个分支
* git branch 查看分支(加 * 表示当前所在分支,查)
* git branch -d tmpbranch  删除临时分支(删)
* git merge tmpbranch  将tmpbranch分支合并到当前所在的分支
* git add 添加新文件或修改的文件到`暂存区(索引,index)`
* git rm 删除本地库的某个文件
* git commit -m "comment" 将更新文件提交到`本地仓库(Local Repository)`
* git checkout -- filename 恢复对某个文件的修改

### 应用场景
###### create a new repository on the command line
```
echo # gde >> README.md
git init
git add README.md
git commit -m "first commit"
git remote add origin git@github.com:webeautiful/gde.git
git push -u origin master
```

##参考资料
* [git简明指南](http://rogerdudler.github.io/git-guide/index.zh.html)
* [git cheatsheet](http://ndpsoftware.com/git-cheatsheet.html#loc=stash)
* [Pro Git](http://git-scm.com/book/zh)
* [git常用命令](http://www.cnblogs.com/1-2-3/archive/2010/07/18/git-commands.html)
* [GitHub秘籍](https://github.com/tiimgreen/github-cheat-sheet/blob/master/README.zh-cn.md)
* [GitHub 丝带](https://github.com/blog/273-github-ribbons)
* [Git配置和常用命令](http://lawrence-zxc.github.io/2011/02/12/git-pro/)
