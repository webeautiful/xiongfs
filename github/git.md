#学习git的原理和使用
该文档收集了日常工作中用到的一些git命令，以及GitHub和git相关的网络资料。

##Git命令
概念: 存档库(Stash), 工作区(Workspace,Index), 暂存区(索引,Index), 本地版本库(Local Repository), 上游版本库(Upstream Repository)

![](http://image.beekka.com/blog/2014/bg2014061202.jpg "git远程工作原理")

###Local Repository

![](http://images.cnitblog.com/blog/221923/201501/061003450151847.png "Local Repository")

根据上面的图片，下面给出了每个部分的简要说明：

* Directory：使用Git管理的一个目录，也就是一个仓库，包含我们的工作空间和Git的管理空间。
* WorkSpace：需要通过Git进行版本控制的目录和文件，这些目录和文件组成了工作空间。
* .git：存放Git管理信息的目录，初始化仓库的时候自动创建。
* Index/Stage：暂存区，或者叫待提交更新区，在提交进入repo之前，我们可以把所有的更新放在暂存区。
* Local Repo：本地仓库，一个存放在本地的版本库；HEAD会只是当前的开发分支（branch）。
* Stash：是一个工作状态保存栈，用于保存/恢复WorkSpace中的临时状态。

###Git远程命令

* [Git远程操作详解](http://www.ruanyifeng.com/blog/2014/06/git_remote.html)
* git push origin master 将`本地仓库(Local Repository)`的修改提交到`远程仓库(Upstream Repository)`
* git pull origin master 拉取远程仓库

###Git本地命令

![](http://images.cnitblog.com/blog/221923/201501/061510341401056.png)

根据上面的图片，对部分命令的用法简要说明：

* git checkout -b newbranch 新建分支(增)
* git checkout abranch  切换到某个分支
* git branch 查看分支(加 * 表示当前所在分支,查)
* git branch -d tmpbranch  删除临时分支(删)
* git merge tmpbranch  将tmpbranch分支合并到当前所在的分支
* git add 添加新文件或修改的文件到`暂存区(索引,index)`
* git reset 用于误添加文件后的恢复
* git rm 删除本地库的某个文件
* git commit -m "comment" 将更新文件提交到`本地仓库(Local Repository)`
* git checkout -- filename 撤销Workspace中的更新(撤销对文件的改动)
* git reset HEAD filename 撤销Stage中的更新(撤销`git add filename`操作)
* git reset --hard HEAD^ 撤销Local Repo中的更新(撤销commit有两种方式:1.使用HEAD指针;2.使用commit id)
* git reset --hard HEAD@{n} 恢复对Local Repo的撤销操作(1.HEAD@{n};2.使用short commit id)
* git reflog -n 记录Local Repo中所有分支的所有更新记录，包括已经撤销的更新
* git log -n 查看最新的n条提交日志,只包括当前分支中的commit记录

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
* [Git版本控制软件结合GitHub从入门到精通常用命令学习手册](http://www.ihref.com/read-16369.html)
