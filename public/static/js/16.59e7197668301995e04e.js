webpackJsonp([16],{"1oos":function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var s=r("Dd8w"),a=r.n(s),o=r("PxNw"),n=r("YjSi"),l=r("GeXn"),i={name:"index.vue",data:function(){return{form:{},refs:{propose:[{required:!0,message:"请填写您的建议",trigger:"blur"}],phone:[{required:!0,message:"请填写您的手机号",trigger:"blur"},{len:11,message:"手机号码格式不正确",trigger:"blur"}],name:[{required:!0,message:"请输入您的真实姓名",trigger:"blur"}]}}},methods:{submitForm:function(){var e=this;this.$refs.form.validate(function(t){t&&l.a.submitOpinion(a()({},e.form)).then(function(t){e.$message.success("提交成功"),e.$refs.form.resetFields()})})}},components:{PersonalHeader:o.a,PersonalMenu:n.a}},c={render:function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("PersonalHeader"),e._v(" "),r("div",{staticClass:"centerBg"},[r("div",{staticClass:"wrapper clearfix"},[r("div",{staticClass:"centerLeft"},[r("PersonalMenu",{staticClass:"fl",attrs:{currentMenu:"7"}})],1),e._v(" "),r("div",{staticClass:"centerRight"},[e._m(0),e._v(" "),r("el-form",{ref:"form",staticClass:"content",attrs:{rules:e.refs,model:e.form,"label-width":"120px"}},[r("el-form-item",{attrs:{label:"意见反馈",prop:"propose"}},[r("el-input",{attrs:{type:"textarea",placeholder:"请填写您的问题或建议"},model:{value:e.form.propose,callback:function(t){e.$set(e.form,"propose",t)},expression:"form.propose"}})],1),e._v(" "),r("el-form-item",{attrs:{label:"手机号码",prop:"phone"}},[r("el-col",{attrs:{span:11}},[r("el-input",{attrs:{placeholder:"请填写您的手机号码"},model:{value:e.form.phone,callback:function(t){e.$set(e.form,"phone",t)},expression:"form.phone"}})],1)],1),e._v(" "),r("el-form-item",{attrs:{label:"真实姓名",prop:"name"}},[r("el-col",{attrs:{span:11}},[r("el-input",{attrs:{placeholder:"请填写您的真实姓名"},model:{value:e.form.name,callback:function(t){e.$set(e.form,"name",t)},expression:"form.name"}})],1)],1),e._v(" "),r("el-form-item",[r("el-button",{attrs:{type:"primary"},on:{click:function(t){return e.submitForm("form")}}},[e._v("提交")])],1)],1)],1)])])],1)},staticRenderFns:[function(){var e=this.$createElement,t=this._self._c||e;return t("div",{staticClass:"centerTitle"},[t("ul",[t("li",{staticClass:"active"},[this._v("意见反馈")])])])}]};var m=r("VU/8")(i,c,!1,function(e){r("JeoQ")},"data-v-4d1eb084",null);t.default=m.exports},JeoQ:function(e,t){}});
//# sourceMappingURL=16.59e7197668301995e04e.js.map