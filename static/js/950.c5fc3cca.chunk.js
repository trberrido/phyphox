"use strict";(self.webpackChunkphyphox_front=self.webpackChunkphyphox_front||[]).push([[950],{469:(e,a,s)=>{s.d(a,{EY:()=>l,LB:()=>i,XT:()=>o,ox:()=>n,sx:()=>t});s(43),s(2);var r=s(579);const i=e=>(0,r.jsxs)("fieldset",{className:"form__fieldset"+(e.className?" "+e.className:""),children:[(0,r.jsx)("legend",{className:"form-fieldset__legend"+(e.legendClassName?" "+e.legendClassName:""),children:e.legend}),e.children]}),n=e=>{const a=e.modificationCSS?e.modificationCSS:"regular",s="color"===e.type?"-color":"",i=e.isHidden?" form__labeled-input-container--hidden":"",n="undefined"===e.min?null:e.min,t="undefined"===e.max?null:e.max;return(0,r.jsxs)("div",{className:"form__labeled-input-container"+i+(e.modificationCSS?" form__labeled-input-container--"+e.modificationCSS:""),children:[(0,r.jsx)("label",{htmlFor:e.id,className:"form__label form__label--"+a,children:e.placeholder}),e.icon?(0,r.jsx)("span",{className:"form__input-icon",children:e.icon}):null,(0,r.jsx)("input",{readOnly:e.readOnly,value:e.value,onChange:e.handleChange,name:e.id,className:"form__input"+s+" form__input--"+a+(e.icon?" form__input-with-icon":" form__input-text-only"),placeholder:e.placeholder,min:n,max:t,type:e.type?e.type:"text",accept:e.accept?e.accept:null,required:e.required})]})},t=e=>(0,r.jsxs)("span",{className:"input-radio__wrapper",children:[(0,r.jsx)("input",{className:"input-radio__input",onChange:e.handleChange,name:e.id,required:e.required,value:e.placeholder,checked:e.checked,type:"radio"}),(0,r.jsx)("label",{htmlFor:e.id,children:e.placeholder})]}),l=e=>(0,r.jsxs)(r.Fragment,{children:[(0,r.jsx)("label",{htmlFor:e.id,className:"form__label form__label--regular",children:e.placeholder}),(0,r.jsx)("textarea",{value:e.value,onChange:e.handleChange,name:e.id,className:"form__textarea form__textarea--regular",placeholder:e.placeholder,type:e.type,required:e.required})]}),o=e=>(0,r.jsx)("input",{className:"form__submit button button--important "+(e.disabled?"form__submit--disabled":""),disabled:e.disabled,type:"submit",value:e.text})},913:(e,a,s)=>{s.d(a,{A:()=>i});s(43);var r=s(579);const i=e=>(0,r.jsx)("p",{className:"message message--"+(e.type?e.type:"info"),children:e.message})},68:(e,a,s)=>{s.d(a,{h:()=>l,r:()=>t});var r=s(43),i=s(141),n=s(579);const t=e=>(0,n.jsxs)("div",{className:"title",children:[(0,n.jsxs)("p",{className:"title__header",children:[e.header,e.icon?(0,n.jsx)("span",{className:"title__icon",children:e.icon}):null,e.image?(0,n.jsx)("img",{className:"title__image",alt:"",src:e.image}):null]}),(0,n.jsx)("h1",{className:"title__content",children:e.content})]}),l=e=>{const a=(0,r.useContext)(i.cr).isAppListening;return document.title=(a?"\ud83d\udfe9":"\ud83d\udfe7")+" phyphox, "+e.content,(0,n.jsx)(t,{header:e.header,content:e.content,image:e.image,icon:e.icon})}},569:(e,a,s)=>{s.r(a),s.d(a,{default:()=>m});var r=s(43),i=s(216),n=s(68),t=s(197),l=s(469),o=s(913),d=s(141),c=(s(2),s(579));const m=()=>{const{isUserAuthentificated:e,setIsUserAuthentificated:a}=(0,r.useContext)(d.pH);let s=(0,i.Zp)();const[m,p]=(0,r.useState)({}),[u,h]=(0,r.useState)({isDisabled:!1,error:!1,step:"email",doesUserExist:(0,i.LG)()}),x=e=>{p({...m,[e.target.name]:e.target.value})};return null===e?(0,c.jsx)(t.A,{}):e?(0,c.jsx)(i.C5,{to:"/administration",replace:!0}):(0,c.jsxs)(c.Fragment,{children:[(0,c.jsx)(n.h,{header:"Adminstration",content:u.doesUserExist?"Log in to your account":"Create a new user"}),u.error&&(0,c.jsx)(o.A,{type:"error",message:u.error}),(0,c.jsxs)("form",{id:"form",className:"form",onSubmit:function(e){e.preventDefault(),h({...u,isDisabled:!0}),fetch(window.API+"/api/user/",{headers:{"Content-Type":"application/json"},method:u.doesUserExist?"PUT":"POST",credentials:"include",body:JSON.stringify(m)}).then((e=>e.json())).then((e=>{e.hasOwnProperty("error")?h({...u,isDisabled:!1,error:e.error}):"email"===u.step?h({...u,error:!1,step:"password",isDisabled:!1}):(a(!0),s("/administration",{replace:!0}))}),(e=>{h({...u,error:e,isDisabled:!1})}))},children:["email"===u.step?(0,c.jsx)(l.ox,{id:"email",modificationCSS:"regular form__label--small",icon:"mail",isHidden:!1,readOnly:!1,placeholder:"Email",value:m.email?m.email:"",handleChange:x,type:"email",required:!0}):(0,c.jsxs)(c.Fragment,{children:[!u.error&&(0,c.jsx)(o.A,{message:"A code has been sent you by email."}),(0,c.jsx)(l.ox,{id:"password",icon:"key",modificationCSS:"regular form__label--small",placeholder:"Received password",value:m.password?m.password:"",handleChange:x,type:"password",required:!0}),(0,c.jsx)("input",{type:"button",className:"form__button--reset",onClick:e=>{e.preventDefault(),h({...u,step:"email"})},value:"Send a new password"}),(0,c.jsx)("br",{})]}),(0,c.jsx)(l.XT,{text:u.doesUserExist?"Authentificate":"Create new user",disabled:u.isDisabled})]})]})}},2:()=>{}}]);
//# sourceMappingURL=950.c5fc3cca.chunk.js.map