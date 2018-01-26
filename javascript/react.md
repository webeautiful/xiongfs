The React Component Lifecycle
===

##### Initialization
![](http://busypeoples.github.io/img/lifecycle_init.png "Initialization")

* getDefaultProps
* getInitialState
* componentWillMount
* render
* componentDidMount

##### State Changes
![](http://busypeoples.github.io/img/lifecycle_state.png "State Changes")

* shouldComponentUpdate
* componentWillUpdate
* render
* componentDidUpdate

##### Props Changes
![](http://busypeoples.github.io/img/lifecycle_props.png "Props Changes")

* componentWillReceiveProps
* shouldComponentUpdate
* componentWillUpdate
* render
* componentDidUpdate

##### Unmounting
![](http://busypeoples.github.io/img/lifecycle_unmount.png "Unmounting")

* componentWillUnmount

##### Lifecycle
![](http://upload-images.jianshu.io/upload_images/2428275-f08403a3ea1b80f4.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

| 生命周期 | 调用次数 | 能否使用 setSate()
:---:|:---:|:---:
| getDefaultProps | 1(全局调用一次) | 否
| getInitialState | 1 | 否
| componentWillMount | 1 | 是
| render |  >=1 | 否
| componentDidMount | 1 | 是
| componentWillReceiveProps | >=0 | 是
| shouldComponentUpdate | >=0 | 否
| componentWillUpdate(nextProps, nextState) | >=0 | 否
| componentDidUpdate(prevProps, prevState) | >=0 | 否
| componentWillUnmount | 1 | 否

### References
* [React.Component](https://facebook.github.io/react/docs/react-component.html)
* [Understanding the React Component Lifecycle](http://busypeoples.github.io/post/react-component-lifecycle/)

### Links
* [react-book](https://github.com/shimohq/react-cookbook)
* [react.rocks](https://react.rocks/)
* [awesome-react](https://github.com/enaqx/awesome-react)
* [javascriptweekly](http://javascriptweekly.com/)
* [react-weekly](https://react.statuscode.com/)
* [awesome-react-native](http://www.awesome-react-native.com/)
* [reactscript](http://reactscript.com/)
