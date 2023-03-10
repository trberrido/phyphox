"use strict";(self.webpackChunkphyphox_front=self.webpackChunkphyphox_front||[]).push([[759],{3653:function(e,a,i){i.d(a,{Z:function(){return z}});var t=i(1413),n=i(885),r=i(2791),l=i(7689),s=i(6246),o=i(2687),d=i(2022),u=i(5373),c=i(4429),p=i(184),h=function(e){var a=e.typesAvailable[e.type].component;return(0,p.jsx)(a,{data:e.visualization,index:e.index,visualizationFormUpdate:e.visualizationFormUpdate,graphLinesAdd:!!e.graphLinesAdd&&e.graphLinesAdd,graphLinesRemove:!!e.graphLinesRemove&&e.graphLinesRemove,graphLinesUpdate:!!e.graphLinesUpdate&&e.graphLinesUpdate,graphLinesStyleUpdate:!!e.graphLinesStyleUpdate&&e.graphLinesStyleUpdate})},x=function(e){return(0,p.jsxs)(p.Fragment,{children:[(0,p.jsx)(u.L_,{id:"title",placeholder:"Visualization title *",value:e.visualization.title,handleChange:e.visualizationFormUpdate,type:"text",required:!0}),(0,p.jsx)(u.ex,{id:"description",handleChange:e.visualizationFormUpdate,placeholder:"Comments",value:e.visualization.description}),(0,p.jsx)(u.pg,{legend:"Python",children:e.visualization.pythonfile.name?(0,p.jsxs)(p.Fragment,{children:[(0,p.jsx)("div",{children:(0,p.jsx)(o.sN,{text:"Remove "+e.visualization.pythonfile.name,confirmedAction:e.fileInputRemove})}),e.visualization.pythonfile.extravariables.map((function(a,i){return(0,p.jsxs)("div",{className:"form-extravariable__wrapper","data-index":i.toString(),children:[(0,p.jsx)(u.L_,{id:"extravariable_"+i.toString(),placeholder:"variable name",value:a,handleChange:e.extraVariableUpdate,type:"text"}),(0,p.jsx)(o.Ei,{value:"delete",classes:"form-extravariable__delete-button",handleClick:e.extraVariableRemove})]},i.toString())})),(0,p.jsx)(o.zx,{text:"Add a variable",handleClick:e.extraVariableAdd})]}):(0,p.jsxs)(p.Fragment,{children:[(0,p.jsx)(u.L_,{id:"pythonfile",placeholder:"Python file",modificationCSS:"variant",handleChange:e.fileInputAdd,accept:".py",type:"file"}),(0,p.jsx)("a",{className:"configuration__link",href:"https://"+window.location.hostname+"/api/python",rel:"noreferrer",target:"_blank",children:"Which version of python should I use ?"})]})}),(0,p.jsx)(s.Z,{size:"small"}),(0,p.jsx)(u.pg,{legend:"Select type *",children:Object.keys(e.visualizationTypes).map((function(a,i){return(0,p.jsx)(u.Y8,{id:"type-"+e.index.toString(),placeholder:a,handleChange:e.visualizationFormTypeUpdate,required:!0,checked:e.visualization.type===a},i.toString()+"-"+a)}))})]})},v=function(e){return(0,p.jsxs)("div",{"data-index":e.index,className:"configuration-visualization",children:[e.isSingle?null:(0,p.jsx)(o.Ei,{value:"delete",classes:"configuration-visualization__delete-button",handleClick:e.visualizationFormRemove}),(0,p.jsx)(x,{index:e.index,extraVariableAdd:e.extraVariableAdd,extraVariableRemove:e.extraVariableRemove,extraVariableUpdate:e.extraVariableUpdate,fileInputAdd:e.fileInputAdd,fileInputRemove:e.fileInputRemove,visualizationTypes:e.visualizationTypes,visualization:e.visualization,visualizationFormTypeUpdate:e.visualizationFormTypeUpdate,visualizationFormUpdate:e.visualizationFormUpdate}),(0,p.jsx)(s.Z,{size:"small"}),e.type&&(0,p.jsx)(h,{typesAvailable:e.visualizationTypes,type:e.type,index:e.index,visualization:e.visualization,value:e.visualization.id,visualizationFormUpdate:e.visualizationFormUpdate,graphLinesAdd:!!e.graphLinesAdd&&e.graphLinesAdd,graphLinesRemove:!!e.graphLinesRemove&&e.graphLinesRemove,graphLinesUpdate:!!e.graphLinesUpdate&&e.graphLinesUpdate,graphLinesStyleUpdate:!!e.graphLinesStyleUpdate&&e.graphLinesStyleUpdate})]})},m={"Single Number":{component:function(e){return(0,p.jsxs)(p.Fragment,{children:[(0,p.jsx)(u.pg,{legend:"phyphox data",children:(0,p.jsx)(u.L_,{id:"id",required:!0,placeholder:"Data ID *",modificationCSS:"variant",value:e.data.id?e.data.id:"",handleChange:e.visualizationFormUpdate,type:"text"})}),(0,p.jsx)(s.Z,{size:"xxsmall"}),(0,p.jsx)(u.pg,{legend:"Options",children:(0,p.jsx)(u.L_,{id:"unit",placeholder:"Unit",modificationCSS:"variant",value:e.data.unit?e.data.unit:"",handleChange:e.visualizationFormUpdate,type:"text"})})]})},id:"",unit:""},Histogram:{component:function(e){return(0,p.jsxs)(p.Fragment,{children:[(0,p.jsx)(u.pg,{legend:"phyphox data",children:(0,p.jsx)(u.L_,{id:"id",required:!0,modificationCSS:"variant",placeholder:"Data ID *",value:e.data.id?e.data.id:"",handleChange:e.visualizationFormUpdate,type:"text"})}),(0,p.jsx)(s.Z,{size:"xxsmall"}),(0,p.jsxs)(u.pg,{legend:"Options",children:[(0,p.jsx)(u.L_,{id:"labelx",modificationCSS:"variant",placeholder:"x axis label",value:e.data.labelx?e.data.labelx:"",handleChange:e.visualizationFormUpdate,type:"text"}),(0,p.jsx)(u.L_,{id:"labely",modificationCSS:"variant",placeholder:"y axis label",value:e.data.labely?e.data.labely:"",handleChange:e.visualizationFormUpdate,type:"text"})]})]})},id:"",labelx:"",xmin:"",xmax:"",labely:"",ymin:"",ymax:"",bucketsnumber:""},Graph:{component:function(e){void 0===e.data.lines&&(e.data.lines=[(0,t.Z)({},c.ZP)]);var a=e.data.lines.length<2;return(0,p.jsxs)(p.Fragment,{children:[(0,p.jsxs)(u.pg,{legend:"phyphox data",children:[(0,p.jsx)(u.L_,{id:"idx",modificationCSS:"variant",required:!0,placeholder:"Data ID x axis *",value:e.data.idx?e.data.idx:"",handleChange:e.visualizationFormUpdate,type:"text"}),(0,p.jsx)(u.L_,{id:"idy",modificationCSS:"variant",required:!0,placeholder:"Data ID y axis *",value:e.data.idy?e.data.idy:"",handleChange:e.visualizationFormUpdate,type:"text"})]}),(0,p.jsx)(s.Z,{size:"xxsmall"}),(0,p.jsxs)(u.pg,{legend:"Options",children:[(0,p.jsx)(u.L_,{id:"labelx",modificationCSS:"variant",placeholder:"x axis label",value:e.data.labelx?e.data.labelx:"",handleChange:e.visualizationFormUpdate,type:"text"}),(0,p.jsx)(u.L_,{id:"labely",modificationCSS:"variant",placeholder:"y axis label",value:e.data.labely?e.data.labely:"",handleChange:e.visualizationFormUpdate,type:"text"})]}),(0,p.jsxs)(p.Fragment,{children:[(0,p.jsx)(s.Z,{size:"xxsmall"}),(0,p.jsxs)(u.pg,{legend:"Customization",children:[e.data.lines.map((function(i,t){return(0,p.jsxs)("div",{"data-index":t.toString(),className:"visualization-graph__line-list",children:[a?null:(0,p.jsx)(o.Ei,{value:"delete",classes:"graph-line__delete-button",handleClick:e.graphLinesRemove}),(0,p.jsx)(u.L_,{id:"idline",placeholder:"Line id",value:i.idline?i.idline:"",modificationCSS:"variant",handleChange:e.graphLinesUpdate}),(0,p.jsx)(u.L_,{id:"colorline",placeholder:"Color",type:"color",modificationCSS:"variant",value:i.colorline?i.colorline:"#ffffff",handleChange:e.graphLinesUpdate})]},t.toString()+"_line")})),(0,p.jsx)(o.zx,{text:"Add a new line",handleClick:e.graphLinesAdd})]})]})]})},xid:"",yid:"",labelx:"",xmin:"",xmax:"",labely:"",ymin:"",ymax:"",lines:[]}},g=i(2918),f=function(e){return(0,p.jsxs)(p.Fragment,{children:[e.error&&(0,p.jsx)(d.Z,{message:e.error,type:"error"}),(0,p.jsx)(u.L_,{id:"title",placeholder:"Project title *",value:e.project.title,handleChange:e.projectFormUpdate,type:"text",required:!0}),(0,p.jsx)(u.ex,{id:"description",placeholder:"Project description",value:e.project.description,handleChange:e.projectFormUpdate})]})},y=function(e){var a=e.visualizations.length<2;return(0,p.jsxs)(p.Fragment,{children:[(0,p.jsx)("h2",{className:"configuration-form__title",children:"List of visualizations"}),(0,p.jsx)("div",{className:"configuration-form__visualizations-list",children:e.visualizations.map((function(i,t){return(0,p.jsx)(v,{index:t,isSingle:a,type:i.type,visualization:i,extraVariableAdd:e.extraVariableAdd,extraVariableRemove:e.extraVariableRemove,extraVariableUpdate:e.extraVariableUpdate,fileInputAdd:e.fileInputAdd,fileInputRemove:e.fileInputRemove,visualizationTypes:e.visualizationTypes,visualizationFormRemove:e.visualizationFormRemove,visualizationFormUpdate:e.visualizationFormUpdate,visualizationFormTypeUpdate:e.visualizationFormTypeUpdate,graphLinesAdd:"Graph"===i.type&&e.graphLinesAdd,graphLinesRemove:"Graph"===i.type&&e.graphLinesRemove,graphLinesUpdate:"Graph"===i.type&&e.graphLinesUpdate,graphLinesStyleUpdate:"Graph"===i.type&&e.graphLinesStyleUpdate},t.toString()+"-"+i.type)}))})]})},z=function(e){var a=(0,r.useState)((0,l.f_)()),i=(0,n.Z)(a,2),d=i[0],h=i[1],x=(0,r.useState)({isDisabled:!1,error:!1}),v=(0,n.Z)(x,2),z=v[0],j=v[1],_=(0,l.s0)(),b="PUT"===e.method?"/"+d.id+".json":"",C=(0,r.useContext)(g.zX).setIsAppListening;return(0,p.jsxs)(p.Fragment,{children:[(0,p.jsx)(s.Z,{size:"small"}),(0,p.jsxs)("form",{className:"form configuration-form",onSubmit:function(a){a.preventDefault(),j((0,t.Z)((0,t.Z)({},z),{},{isDisabled:!0}));var i=new Headers;i.append("Content-Type","application/json"),fetch("https://"+window.location.hostname+"/api/configurations"+b,{method:e.method,credentials:"include",headers:i,body:JSON.stringify(d)}).then((function(e){return e.json()})).then((function(e){if(e.hasOwnProperty("error"))j((0,t.Z)((0,t.Z)({},z),{},{isDisabled:!1,error:e.error}));else{var a=e.filename,i=Date.now();fetch("https://"+window.location.hostname+"/api/app/state.json",{method:"PUT",credentials:"include",body:JSON.stringify({isListening:!0,currentConfiguration:a,startedAt:i})}).then((function(e){return e.json()})).then((function(e){C(!0),_("/")}))}}),(function(e){j((0,t.Z)((0,t.Z)({},z),{},{isDisabled:!1,error:e}))}))},children:[(0,p.jsx)(f,{project:d,projectFormUpdate:function(e){var a=structuredClone(d);a[e.target.name]=e.target.value,h(a)},error:z.error}),(0,p.jsx)(s.Z,{size:"large"}),(0,p.jsx)(y,{visualizations:d.visualizations,visualizationTypes:m,extraVariableAdd:function(e){var a=e.currentTarget.closest(".configuration-visualization").dataset.index,i=structuredClone(d);i.visualizations[a].pythonfile.extravariables.push(""),h(i)},extraVariableRemove:function(e){var a=e.currentTarget.closest(".configuration-visualization").dataset.index,i=structuredClone(d),t=e.currentTarget.closest(".form-extravariable__wrapper").dataset.index;i.visualizations[a].pythonfile.extravariables.splice(t,1),h(i)},extraVariableUpdate:function(e){var a=e.currentTarget.closest(".configuration-visualization").dataset.index,i=structuredClone(d),t=e.currentTarget.closest(".form-extravariable__wrapper").dataset.index;i.visualizations[a].pythonfile.extravariables[t]=e.target.value,h(i)},fileInputAdd:function(e){var a=e.currentTarget.files[0],i=structuredClone(d),t=e.currentTarget.closest(".configuration-visualization").dataset.index,n=new FileReader;n.onload=function(){i.visualizations[t].pythonfile.name=a.name,i.visualizations[t].pythonfile.data=n.result,h(i)},n.readAsDataURL(a)},fileInputRemove:function(e){var a=e.currentTarget.closest(".configuration-visualization").dataset.index,i=structuredClone(d);i.visualizations[a].pythonfile=structuredClone(c.T7),h(i)},visualizationFormRemove:function(e){var a=e.currentTarget.closest(".configuration-visualization").dataset.index,i=structuredClone(d);i.visualizations.splice(a,1),h(i)},visualizationFormUpdate:function(e){var a=e.currentTarget.closest(".configuration-visualization").dataset.index,i=structuredClone(d);i.visualizations[a][e.target.name]=e.target.value,h(i)},visualizationFormTypeUpdate:function(e){var a=e.currentTarget.closest(".configuration-visualization").dataset.index,i=structuredClone(d);i.visualizations[a].type=e.target.value,h(i)},graphLinesAdd:function(e){var a=e.currentTarget.closest(".configuration-visualization").dataset.index,i=d.visualizations[a].lines.concat((0,t.Z)({},c.ZP)),n=structuredClone(d);n.visualizations[a].lines=i,h(n)},graphLinesRemove:function(e){var a=e.currentTarget.closest(".configuration-visualization").dataset.index,i=e.currentTarget.closest(".visualization-graph__line-list").dataset.index,t=structuredClone(d);t.visualizations[a].lines.splice(i,1),h(t)},graphLinesUpdate:function(e){var a=e.currentTarget.closest(".configuration-visualization").dataset.index,i=e.currentTarget.closest(".visualization-graph__line-list").dataset.index,t=structuredClone(d);t.visualizations[a].lines[i][e.target.name]=e.target.value,h(t)},graphLinesStyleUpdate:function(e){var a=e.currentTarget.closest(".configuration-visualization").dataset.index,i=e.currentTarget.closest(".visualization-graph__line-list").dataset.index,t=structuredClone(d);t.visualizations[a].lines[i].style=e.target.value,h(t)}}),(0,p.jsxs)("div",{className:"configuration-form__commands",children:[(0,p.jsx)(o.zx,{icon:"library_add",text:"Add a new visualization",handleClick:function(e){e.preventDefault();var a=d.visualizations.concat(structuredClone(c._P)),i=structuredClone(d);i.visualizations=a,h(i)}}),(0,p.jsx)(u.k4,{text:"Start to listen datas",disabled:z.isDisabled})]})]})]})}},5373:function(e,a,i){i.d(a,{L_:function(){return r},Y8:function(){return l},ex:function(){return s},k4:function(){return o},pg:function(){return n}});i(2791),i(9109);var t=i(184),n=function(e){return(0,t.jsxs)("fieldset",{className:"form__fieldset"+(e.className?" "+e.className:""),children:[(0,t.jsx)("legend",{className:"form-fieldset__legend",children:e.legend}),e.children]})},r=function(e){var a=e.modificationCSS?e.modificationCSS:"regular",i="color"===e.type?"-color":"",n=e.isHidden?" form__labeled-input-container--hidden":"";return(0,t.jsxs)("div",{className:"form__labeled-input-container"+n+(e.modificationCSS?" form__labeled-input-container--"+e.modificationCSS:""),children:[(0,t.jsx)("label",{htmlFor:e.id,className:"form__label form__label--"+a,children:e.placeholder}),e.icon?(0,t.jsx)("span",{className:"form__input-icon",children:e.icon}):null,(0,t.jsx)("input",{readOnly:e.readOnly,value:e.value,onChange:e.handleChange,name:e.id,className:"form__input"+i+" form__input--"+a+(e.icon?" form__input-with-icon":" form__input-text-only"),placeholder:e.placeholder,type:e.type?e.type:"text",accept:e.accept?e.accept:null,required:e.required})]})},l=function(e){return(0,t.jsxs)("span",{className:"input-radio__wrapper",children:[(0,t.jsx)("input",{className:"input-radio__input",onChange:e.handleChange,name:e.id,required:e.required,value:e.placeholder,checked:e.checked,type:"radio"}),(0,t.jsx)("label",{htmlFor:e.id,children:e.placeholder})]})},s=function(e){return(0,t.jsxs)(t.Fragment,{children:[(0,t.jsx)("label",{htmlFor:e.id,className:"form__label form__label--regular",children:e.placeholder}),(0,t.jsx)("textarea",{value:e.value,onChange:e.handleChange,name:e.id,className:"form__textarea form__textarea--regular",placeholder:e.placeholder,type:e.type,required:e.required})]})},o=function(e){return(0,t.jsx)("input",{className:"form__submit button button--important "+(e.disabled?"form__submit--disabled":""),disabled:e.disabled,type:"submit",value:e.text})}},2022:function(e,a,i){i.d(a,{Z:function(){return n}});i(2791);var t=i(184),n=function(e){return(0,t.jsx)("p",{className:"message message--"+(e.type?e.type:"info"),children:e.message})}},6246:function(e,a,i){i.d(a,{Z:function(){return n}});var t=i(184),n=function(e){return(0,t.jsx)("div",{className:"spacer"+(e.size?"--"+e.size:"")})}},5102:function(e,a,i){i.d(a,{D:function(){return s},H:function(){return l}});var t=i(2791),n=i(2918),r=i(184),l=function(e){return(0,r.jsxs)("div",{className:"title",children:[(0,r.jsxs)("p",{className:"title__header",children:[e.header,e.icon?(0,r.jsx)("span",{className:"title__icon",children:e.icon}):null,e.image?(0,r.jsx)("img",{className:"title__image",alt:"",src:e.image}):null]}),(0,r.jsx)("h1",{className:"title__content",children:e.content})]})},s=function(e){var a=(0,t.useContext)(n.zX).isAppListening;return document.title=(a?"\ud83d\udfe9":"\ud83d\udfe7")+" phyphox, "+e.content,(0,r.jsx)(l,{header:e.header,content:e.content,image:e.image,icon:e.icon})}},9109:function(){}}]);
//# sourceMappingURL=759.e51c2799.chunk.js.map