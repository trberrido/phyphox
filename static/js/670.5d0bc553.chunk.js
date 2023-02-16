"use strict";(self.webpackChunkpypox_front=self.webpackChunkpypox_front||[]).push([[670],{5590:function(e,n,t){t.d(n,{Z:function(){return m}});var i=t(2982),l=t(1413),a=t(885),r=t(2791),o=t(1087),s=t(2022),c=t(4335),d=t(2918),u=t(184),f=function(e){var n=(0,r.useContext)(d.gd).isUserAuthentificated,t=(0,r.useState)(!1),i=(0,a.Z)(t,2),l=i[0],s=i[1];return(0,u.jsxs)("li",{className:"file-list__item"+(l?" file-list__item--deleting":""),"data-filename":e.item.filename,children:[(0,u.jsx)("span",{children:e.item.id}),(0,u.jsx)("br",{}),(0,u.jsx)(o.rU,{className:"file-list__link"+(l?" file-list__link--disabled":""),"aria-disabled":l,to:e.actionURL+e.item.id,children:e.actionName}),e.isDuplicable?(0,u.jsx)("a",{className:"file-list__link"+(l?" file-list__link--disabled":""),onClick:e.isDuplicable,href:"https://"+window.location.hostname+"/api/"+e.collection+"/"+e.item.filename,children:"Duplicate"}):null,e.isDownloadable?(0,u.jsxs)("a",{className:"file-list__link"+(l?" file-list__link--disabled":""),href:e.downloadURL,target:"_blank",rel:"noreferrer","aria-disabled":l,download:!0,children:["download (json file, ",Math.round(e.item.filesize/1024)," KB)"]}):null,n?(0,u.jsx)("a",{className:"file-list__link"+(l?" file-list__link--disabled":""),target:"_blank",rel:"noreferrer",onClick:function(n){n.preventDefault(),e.deleteItem(n),s(!0)},href:"https://"+window.location.hostname+"/api/"+e.collection+"/"+e.item.filename,children:"delete"}):null]})};var m=function(e){var n=(0,r.useState)({error:null,isLoaded:!1,items:[]}),t=(0,a.Z)(n,2),o=t[0],d=t[1],m=function(e){e.preventDefault();var n=e.currentTarget.href;fetch(n,{credentials:"include",method:"POST"}).then((function(e){return e.json()})).then((function(e){e.hasOwnProperty("error")||d((0,l.Z)((0,l.Z)({},o),{},{items:e}))}))},h=function(e){var n=e.currentTarget.href,t=e.currentTarget.closest(".file-list__item");fetch(n,{credentials:"include",method:"DELETE"}).then((function(e){return e.json()})).then((function(e){if(!e.hasOwnProperty("error")){var n=(0,i.Z)(o.items);d((0,l.Z)((0,l.Z)({},o),{},{items:n.filter((function(e){return e.filename!==t.dataset.filename}))}))}}))};return(0,r.useEffect)((function(){o.isLoaded||fetch("https://"+window.location.hostname+"/api/"+e.collection,{method:"GET"}).then((function(e){return e.json()})).then((function(e){e.hasOwnProperty("error")?d((0,l.Z)((0,l.Z)({},o),{},{error:e.error,isLoaded:!0})):d((0,l.Z)((0,l.Z)({},o),{},{items:e,isLoaded:!0}))}),(function(e){d((0,l.Z)((0,l.Z)({},o),{},{isLoaded:!0,error:e}))}))}),[e.collection,o]),o.error?(0,u.jsx)(s.Z,{type:"error",message:o.error}):o.isLoaded?o.items.length?(0,u.jsx)("ul",{className:"file-list",children:o.items.map((function(n){return(0,u.jsx)(f,{isDownloadable:e.isDownloadable,isDuplicable:!!e.optionDuplicate&&m,downloadURL:"https://"+window.location.hostname+"/api/"+e.collection+"/"+n.filename,item:n,collection:e.collection,actionName:e.actionName,actionURL:e.actionURL,deleteItem:h},n.filename)}))}):(0,u.jsx)("p",{children:"Nothing yet."}):(0,u.jsx)(c.Z,{})}},2022:function(e,n,t){t.d(n,{Z:function(){return l}});t(2791);var i=t(184),l=function(e){return(0,i.jsx)("p",{className:"message message--"+(e.type?e.type:"info"),children:e.message})}},5102:function(e,n,t){t.d(n,{D:function(){return o},H:function(){return r}});var i=t(2791),l=t(2918),a=t(184),r=function(e){return(0,a.jsxs)("div",{className:"title",children:[(0,a.jsxs)("p",{className:"title__header",children:[e.header,e.icon?(0,a.jsx)("span",{className:"title__icon",children:e.icon}):null,e.image?(0,a.jsx)("img",{className:"title__image",alt:"",src:e.image}):null]}),(0,a.jsx)("h1",{className:"title__content",children:e.content})]})},o=function(e){var n=(0,i.useContext)(l.zX).isAppListening;return document.title=(n?"\ud83d\udfe9":"\ud83d\udfe7")+" pypox, "+e.content,(0,a.jsx)(r,{header:e.header,content:e.content,image:e.image,icon:e.icon})}},2670:function(e,n,t){t.r(n);var i=t(5671),l=t(3144),a=t(136),r=t(7277),o=t(2791),s=t(5102),c=t(5590),d=t(184),u=function(e){(0,a.Z)(t,e);var n=(0,r.Z)(t);function t(){return(0,i.Z)(this,t),n.apply(this,arguments)}return(0,l.Z)(t,[{key:"render",value:function(){return(0,d.jsxs)(d.Fragment,{children:[(0,d.jsx)(s.D,{header:"Search, see, download",content:"Previous experiments"}),(0,d.jsx)(c.Z,{collection:"experiments",actionName:"See graph",actionURL:"/experiment/",isDownloadable:!0})]})}}]),t}(o.Component);n.default=u}}]);
//# sourceMappingURL=670.5d0bc553.chunk.js.map