webpackJsonp([23],{"KAG/":function(t,a,s){"use strict";Object.defineProperty(a,"__esModule",{value:!0});var i=s("PxNw"),n=s("YjSi"),e=s("GeXn"),v={name:"index.vue",data:function(){return{dialogVisible:!1,consultId:"",type:0}},mounted:function(){this.getData()},methods:{getData:function(){var t=this;e.a.getConsoleManage().then(function(a){t.data=a})},tabChange:function(t){var a=t.target.dataset.type;this.type=a}},components:{PersonalHeader:i.a,PersonalMenu:n.a}},l={render:function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("div",[s("PersonalHeader"),t._v(" "),s("div",{staticClass:"centerBg"},[s("div",{staticClass:"wrapper clearfix"},[s("div",{staticClass:"centerLeft"},[s("PersonalMenu",{staticClass:"fl",attrs:{currentMenu:"6"}})],1),t._v(" "),s("div",{staticClass:"centerRight"},[s("div",{staticClass:"centerTitle"},[s("ul",[s("router-link",{attrs:{to:"/account"}},[s("li",[t._v("账户中心")])]),t._v(" "),s("router-link",{attrs:{to:"/investorManage"}},[s("li",{staticClass:"active"},[t._v("投资者管理")])]),t._v(" "),s("router-link",{attrs:{to:"/leaveManage"}},[s("li",[t._v("留言管理")])])],1),t._v(" "),s("span",{staticClass:"brandBtn"},[t._v("我的品牌页 >")])]),t._v(" "),s("div",{staticClass:"invBox"},[s("ul",{staticClass:"invNav clearfix",on:{click:t.tabChange}},[s("li",{class:[0==t.type?"active":""],attrs:{"data-type":"0"}},[t._v("待跟进")]),t._v(" "),s("li",{class:[1==t.type?"active":""],attrs:{"data-type":"0"}},[t._v("正在跟进")]),t._v(" "),s("li",{class:[2==t.type?"active":""],attrs:{"data-type":"0"}},[t._v("已签约")]),t._v(" "),s("li",{class:[3==t.type?"active":""],attrs:{"data-type":"0"}},[t._v("已放弃")])]),t._v(" "),s("div",{staticClass:"invList"},[t._m(0),t._v(" "),t._m(1),t._v(" "),s("dl",[s("dt",{staticClass:"clearfix"},[t._m(2),t._v(" "),s("div",{staticClass:"status fr"},[s("i",[t._v("2019-06-28")]),t._v(" "),s("span",{on:{click:function(a){t.dialogVisible=!0,t.consultId=t.item.id}}},[t._v("查看")])])]),t._v(" "),s("dd",[t._v("这里是留言内容，这里是留言内容，这里是留言内容，这里是留言内容，这里是留言内容")])])]),t._v(" "),s("el-pagination",{staticClass:"pages",attrs:{background:"",layout:"prev, pager, next",total:t.count}})],1)]),t._v(" "),s("el-dialog",{staticClass:"model1",attrs:{title:"未跟进",visible:t.dialogVisible,width:"40%","before-close":t.handleClose,center:""},on:{"update:visible":function(a){t.dialogVisible=a}}},[s("div",{staticClass:"box"},[s("span",[t._v("姓名：王先生     ")]),t._v(" "),s("span",[t._v("性别：男     ")]),t._v(" "),s("span",[t._v("电话：18231861411")]),t._v(" "),s("div",{staticClass:"consult"},[t._v("\n              这里是留言内容，这里是留言内容，这里是留言内容，这里是留言内容这里是留言内容，这里是留言内容\n            ")])]),t._v(" "),s("div",{staticClass:"box"},[s("div",[s("span",[t._v("投资意向：")]),t._v(" "),s("span",{staticClass:"iconfont icon-xingxing currentColor"}),t._v(" "),s("span",{staticClass:"iconfont icon-xingxing"}),t._v(" "),s("span",{staticClass:"iconfont icon-xingxing"}),t._v(" "),s("span",{staticClass:"iconfont icon-xingxing"}),t._v(" "),s("span",{staticClass:"iconfont icon-xingxing"})]),t._v(" "),s("div",[s("span",[t._v("选择状态：")]),t._v(" "),s("label",{staticClass:" currentColor",attrs:{for:""}},[s("span",{staticClass:"iconfont icon-dian"}),t._v("正在跟进  \n              ")]),t._v(" "),s("label",{attrs:{for:""}},[s("span",{staticClass:"iconfont icon-dian"}),t._v("放弃跟进  \n              ")]),t._v(" "),s("label",{attrs:{for:""}},[s("span",{staticClass:"iconfont icon-dian"}),t._v("已经签约  \n              ")])]),t._v(" "),s("div",[t._v("客户跟踪日志：")]),t._v(" "),s("div",{staticClass:"logs"},[s("div",{staticClass:"log"},[s("div",[t._v("与客户见面了，沟通很顺利，客户对整理的资料相当满意，签约的意向很大客户对整理的资料相当满意")]),t._v(" "),s("div",{staticClass:"time"},[t._v("07-08 09:10")])])]),t._v(" "),s("textarea",{staticClass:"addlog",attrs:{type:"textarea",placeholder:"请在此添加日志~"}}),t._v(" "),s("span",{staticClass:"dialog-footer",attrs:{slot:"footer"},slot:"footer"},[s("el-button",{attrs:{type:"primary"},on:{click:function(a){t.dialogVisible=!1}}},[t._v("保 存")])],1)])])],1)])],1)},staticRenderFns:[function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("dl",[s("dt",{staticClass:"clearfix"},[s("div",{staticClass:"data fl"},[t._v("王先生"),s("span",[t._v("|")]),t._v("男"),s("span",[t._v("|")]),t._v("18333151234")]),t._v(" "),s("div",{staticClass:"status fr"},[s("i",[t._v("2019-06-28")]),t._v(" "),s("span",[t._v("查看")])])]),t._v(" "),s("dd",[t._v("这里是留言内容，这里是留言内容，这里是留言内容，这里是留言内容，这里是留言内容")])])},function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("dl",[s("dt",{staticClass:"clearfix"},[s("div",{staticClass:"data fl"},[t._v("王先生"),s("span",[t._v("|")]),t._v("男"),s("span",[t._v("|")]),t._v("18333151234")]),t._v(" "),s("div",{staticClass:"status fr"},[s("i",[t._v("2019-06-28")]),t._v(" "),s("span",[t._v("查看")])])]),t._v(" "),s("dd",[t._v("这里是留言内容，这里是留言内容，这里是留言内容，这里是留言内容，这里是留言内容")])])},function(){var t=this.$createElement,a=this._self._c||t;return a("div",{staticClass:"data fl"},[this._v("王先生"),a("span",[this._v("|")]),this._v("男"),a("span",[this._v("|")]),this._v("18333151234")])}]};var c=s("VU/8")(v,l,!1,function(t){s("wzNe")},"data-v-04ac3d7e",null);a.default=c.exports},wzNe:function(t,a){}});
//# sourceMappingURL=23.d724afa8cbb55abbbff5.js.map