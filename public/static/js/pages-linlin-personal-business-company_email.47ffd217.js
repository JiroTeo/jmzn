(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-linlin-personal-business-company_email"],{"14f3":function(t,n,e){"use strict";var a=e("5c10"),i=e.n(a);i.a},"199c":function(t,n,e){"use strict";e.r(n);var a=e("f821"),i=e.n(a);for(var o in a)"default"!==o&&function(t){e.d(n,t,function(){return a[t]})}(o);n["default"]=i.a},"536e":function(t,n,e){"use strict";e.r(n);var a=e("c2f5"),i=e("199c");for(var o in i)"default"!==o&&function(t){e.d(n,t,function(){return i[t]})}(o);e("14f3");var r=e("2877"),c=Object(r["a"])(i["default"],a["a"],a["b"],!1,null,"d0a6f8d6",null);n["default"]=c.exports},"5c10":function(t,n,e){var a=e("71f7");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var i=e("4f06").default;i("2351bfc1",a,!0,{sourceMap:!1,shadowMode:!1})},"71f7":function(t,n,e){n=t.exports=e("2350")(!1),n.push([t.i,".fullName[data-v-d0a6f8d6]{min-height:100vh;background-color:#f5f6fb}.writeInp[data-v-d0a6f8d6]{display:block;width:92%;padding:0 4%;height:%?96?%;line-height:%?96?%;background:#fff;margin:%?20?% 0 %?50?%;border:none;font-size:%?28?%}.keepBtn[data-v-d0a6f8d6]{display:block;width:92%;height:%?92?%;line-height:%?92?%;text-align:center;border-radius:%?4?%;font-size:%?30?%;margin:0 auto;background:-webkit-gradient(linear,100% 0,0 0,from(#579efa),to(#5074f4));background:-webkit-linear-gradient(180deg,#579efa,#5074f4);background:-moz-linear-gradient(to bottom,#579efa,#5074f4);background:-o-linear-gradient(to bottom,#579efa,#5074f4);background:-webkit-gradient(linear,left top,left bottom,from(#579efa),to(#5074f4));background:-o-linear-gradient(top,#579efa,#5074f4);background:linear-gradient(180deg,#579efa,#5074f4);color:#fff}",""])},c2f5:function(t,n,e){"use strict";var a=function(){var t=this,n=t.$createElement,e=t._self._c||n;return e("v-uni-view",{staticClass:"fullName"},[e("v-uni-view",{staticClass:"common-head"},[e("v-uni-image",{staticClass:"arrow-back",attrs:{src:"../../../../static/icon_arrow.png"},on:{click:function(n){n=t.$handleEvent(n),t.returnClick(n)}}}),e("v-uni-view",{staticClass:"common-title"},[t._v("联系邮箱")])],1),e("v-uni-view",[e("v-uni-input",{staticClass:"writeInp",attrs:{type:"text",placeholder:"请填写您的联系邮箱"},on:{input:function(n){n=t.$handleEvent(n),t.nameInput(n)}}}),e("v-uni-view",{staticClass:"keepBtn",on:{click:function(n){n=t.$handleEvent(n),t.keepClick(n)}}},[t._v("保存")])],1)],1)},i=[];e.d(n,"a",function(){return a}),e.d(n,"b",function(){return i})},f821:function(t,n,e){"use strict";Object.defineProperty(n,"__esModule",{value:!0}),n.default=void 0;var a={data:function(){return{name:""}},onLoad:function(){},methods:{nameInput:function(t){this.name=t.detail.value},keepClick:function(){""!=this.name?this.request({url:"/wap/user/edit_user_data",method:"post",data:{type:9,email:this.name},success:function(t){t.code;var n=t.msg;t.data;uni.showToast({title:n,icon:"none"}),setTimeout(function(){uni.navigateTo({url:"account"})},1e3)},fail:function(t){console.log(t),uni.showToast({title:t.msg,icon:"none"})}}):uni.showToast({title:"请输入要修改的邮箱",icon:"none"})},returnClick:function(){uni.navigateBack({delta:1})}}};n.default=a}}]);