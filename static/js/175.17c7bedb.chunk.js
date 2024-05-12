"use strict";(self.webpackChunkphyphox_front=self.webpackChunkphyphox_front||[]).push([[175],{175:(e,t,i)=>{i.d(t,{A:()=>E});var n=i(43),a=i(536);const s=(e,t)=>{const i=a.GPZ(".1e");return"Scientific"===t?i(parseFloat(e)):parseFloat(e).toFixed(2)};var o=i(579);const r=e=>{let t;return t=isNaN(s(e.data,e.notation))?"_.__":s(e.data,e.notation),(0,o.jsxs)(o.Fragment,{children:[(0,o.jsx)("p",{className:"visualization-number__output",children:t}),(0,o.jsx)("p",{className:"visualization-number__unit",children:e.unit})]})},l=e=>(0,o.jsx)("rect",{transform:"translate(".concat(e.margins.left,", ").concat(e.margins.top,")"),stroke:e.stroke,fill:"transparent",width:e.width,height:e.height}),c=e=>{const t=e.dimensions,i=e.margins,a=(0,n.useMemo)((()=>e.yScale.ticks(4).filter((e=>Number.isInteger(e))).map((t=>({value:t,yOffset:e.yScale(t)})))),[e]);return(0,o.jsxs)("svg",{children:[e.label?(0,o.jsx)("text",{fill:"currentColor",transform:"rotate(-90)",textAnchor:"middle",fontSize:"30",x:-t.height/2,y:"30",children:e.label}):null,(0,o.jsx)("path",{d:["M",i.left,i.top,"v",t.height-(i.top+i.bottom)].join(" "),fill:"none",stroke:"currentColor"}),a.map((n=>{let{value:a,yOffset:r}=n;return(0,o.jsxs)("g",{transform:"translate(0, ".concat(r+i.top,")"),children:[(0,o.jsx)("line",{x1:i.left,x2:t.width-i.right,stroke:e.colors.stick}),(0,o.jsx)("text",{transform:"translate(".concat(i.left-10,", ").concat("Histogram"===e.type?0:10,")"),fontSize:"30",textAnchor:"end",fill:"currentColor",children:"Graph"===e.type&&"Scientific"===e.notation?s(a,e.notation):a})]},a)}))]})},m=e=>{const t=e.dimensions,i=e.margins,a=(0,n.useMemo)((()=>e.xScale.ticks(4).map((t=>({value:t,xOffset:e.xScale(t)})))),[e]);return(0,o.jsxs)("svg",{children:[e.label?(0,o.jsx)("text",{fill:"currentColor",textAnchor:"middle",fontSize:"30",x:t.width/2,y:t.height-8,children:e.label}):null,(0,o.jsx)("path",{d:["M",i.left,t.height-i.bottom,"h",t.width-(i.left+i.right)].join(" "),fill:"none",stroke:"currentColor"}),a.map(((n,a)=>{let{value:r,xOffset:l}=n;return(0,o.jsxs)("g",{transform:"translate(".concat(l+i.left,", 0)"),children:[(0,o.jsx)("line",{y1:i.top,y2:t.height-i.bottom,stroke:e.colors.stick}),(0,o.jsx)("text",{transform:"translate(0,".concat(t.height+i.top-i.bottom,")"),fontSize:"30",textAnchor:"middle",fill:"currentColor",children:"Scientific"===e.notation?s(r,e.notation):r})]},r+a.toString())}))]})},x=e=>{const t=e.dimensions.height-(e.margins.top+e.margins.bottom),i=(e.dimensions.width-e.margins.left-e.margins.right)/e.bins;return(0,o.jsx)("rect",{stroke:"black",fill:"white",opacity:.8,x:e.xScale(e.bucket.x0),width:i,y:e.yScale(e.bucket.length),height:t-e.yScale(e.bucket.length)})},h=e=>{const t=e.colors,i=e.margins,r=e.data,h=e.dimensions,d=e.domain,A=e.bins?parseInt(e.bins):10,g=()=>{let[e,t]=[0,1];return r.length>0&&([e,t]=a.Xxv(r)),"number"==typeof d.x.min&&(e=d.x.min),"number"==typeof d.x.max&&(t=d.x.max),[e,t]},p=(0,n.useMemo)((()=>{let[e,t]=g();const i=a.y17(e,t,(t-e)/A);let n=a.e5v().thresholds(i)(r),s=0;for(let a=i.length;a>=0;a--)if(i[a]<n[0][0]){s=a;break}for(let a=0;a<n.length;a++)n[a].x0=i[s+a],n[a].x1=n[a].x0+(t-e)/A;return n}),[r,A]),u=(0,n.useMemo)((()=>a.m4Y().range([h.height-(i.top+i.bottom),0]).domain([0,1.1*Math.max(...p.map((e=>e.length)))]).nice()),[p,h,i]),y=(0,n.useMemo)((()=>{const[e,t]=g();return a.m4Y().range([0,h.width-(i.left+i.right)]).domain([e,t])}),[r,h,i,d]);return(0,o.jsxs)(o.Fragment,{children:[(0,o.jsxs)("svg",{width:h.width,height:h.height,children:[(0,o.jsx)("rect",{transform:"translate(".concat(i.left,", ").concat(i.top,")"),fill:t.background,width:h.width-(i.left+i.right),height:h.height-(i.top+i.bottom)}),r.length>0&&(0,o.jsx)("g",{width:h.width-(i.left+i.right),height:h.height-(i.top+i.bottom),transform:"translate(".concat(i.left,", ").concat(i.top,")"),children:p.map(((e,t)=>(0,o.jsx)(x,{bins:A,xScale:y,yScale:u,bucket:e,dimensions:h,margins:i},t.toString())))}),(0,o.jsx)(c,{type:"Histogram",yScale:u,dimensions:h,margins:i,colors:t,label:!!e.axisLabel.y&&e.axisLabel.y}),(0,o.jsx)(m,{xScale:y,notation:e.notation,dimensions:h,margins:i,colors:t,label:!!e.axisLabel.x&&e.axisLabel.x}),(0,o.jsx)(l,{width:h.width-(i.left+i.right),height:h.height-(i.top+i.bottom),stroke:t.text,margins:i})]}),(0,o.jsxs)("p",{className:"histogram-infos",children:[(0,o.jsxs)("span",{className:"histogram-infos__item",children:["mean: ",s(a.i2o(r),e.notation)]}),(0,o.jsxs)("span",{className:"histogram-infos__item",children:["median: ",s(a.JZy(r),e.notation)]}),(0,o.jsxs)("span",{className:"histogram-infos__item",children:["deviation: ",r.length>1?s(a.KSm(r),e.notation):" - "]})]})]})},d=e=>(0,o.jsx)("div",{className:"graph-legendes__wrapper",children:e.data.map(((e,t)=>e.idline?(0,o.jsxs)("div",{className:"graph-legende",children:[(0,o.jsx)("div",{style:{background:e.colorline},className:"graph-legende__colorsquare"}),(0,o.jsx)("p",{className:"graph-legende__text",children:e.idline})]},e.idline+"_"+t.toString()):null))}),A=e=>(0,o.jsx)("path",{fill:"none",stroke:e.color,strokeWidth:3,d:e.coordinates.x.map(((t,i)=>(i?" L ":"M ")+e.xScale(t)+" "+e.yScale(e.coordinates.y[i]))).join(" ")}),g=e=>(0,o.jsx)(o.Fragment,{children:e.plots.x.map(((t,i)=>(0,o.jsx)("circle",{cx:e.xScale(t),cy:e.yScale(e.plots.y[i]),r:6,fill:e.color?e.color:"white"},i.toString())))}),p=e=>{const t=e.margins,i=e.domain,s=e.lines,r=e.data.fits?e.data.fits:null,x=e.data.measures?e.data.measures:null,h=e.colors,p=e.dimensions,u=(0,n.useRef)(null),y=r&&Object.keys(r).length?s.map((e=>({coordinates:r[e.idline],color:e.colorline,style:e.styleline}))):null,f=(0,n.useMemo)((()=>{if(null===x&&null===r)return{x0:"number"==typeof i.x.min?i.x.min:0,x1:"number"==typeof i.x.max?i.x.max:1,y0:"number"==typeof i.y.min?i.y.min:0,y1:"number"==typeof i.y.max?i.y.max:1};const e=[...x,...Object.values(r)].map((e=>({x0:Math.min(...e.x),x1:Math.max(...e.x),y0:Math.min(...e.y),y1:Math.max(...e.y)}))).reduce(((e,t)=>({x0:e.x0<t.x0?e.x0:t.x0,x1:e.x1>t.x1?e.x1:t.x1,y0:e.y0<t.y0?e.y0:t.y0,y1:e.y1>t.y1?e.y1:t.y1})));return{x0:"number"==typeof i.x.min?i.x.min:e.x0,x1:"number"==typeof i.x.max?i.x.max:e.x1,y0:"number"==typeof i.y.min?i.y.min:e.y0,y1:"number"==typeof i.y.max?i.y.max:e.y1}}),[x,r,i]),[j,b]=(0,n.useState)({x:a.m4Y().range([0,p.width-(t.left+t.right)]).domain([f.x0,f.x1]),y:a.m4Y().range([p.height-(t.top+t.bottom),0]).domain([f.y0,f.y1]).nice()}),N=(e,t)=>.05*(t-e),w=N(f.x0,f.x1),E=N(f.y0,f.y1),F="number"==typeof i.x.max?0:w,v="number"==typeof i.x.min?0:w,k="number"==typeof i.y.max?0:E,G="number"==typeof i.y.min?0:E;return(0,n.useEffect)((()=>{b({x:a.m4Y().range([0,p.width-(t.left+t.right)]).domain([f.x0-v,f.x1+F]),y:a.m4Y().range([p.height-(t.top+t.bottom),0]).domain([f.y0-G,f.y1+k]).nice()})}),[p,f,w,E]),(0,n.useEffect)((()=>{if(e.isOnGoingExperiment)return;const i=a.s_O().scaleExtent([.9,3]).translateExtent([[0,0],[p.width,p.height]]).on("zoom",(e=>{const i=e.transform,n=i.rescaleX(j.x),s=i.rescaleY(j.y);b({x:a.m4Y().range([0,p.width-(t.left+t.right)]).domain(n.domain()),y:a.m4Y().range([p.height-(t.top+t.bottom),0]).domain(s.domain()).nice()})}));a.Ltv(u.current).call(i)}),[p,e.isOnGoingExperiment]),(0,o.jsxs)(o.Fragment,{children:[(0,o.jsxs)("svg",{width:p.width,height:p.height,ref:u,children:[(0,o.jsx)("rect",{transform:"translate(".concat(t.left,", ").concat(t.top,")"),fill:h.background,width:p.width-(t.left+t.right),height:p.height-(t.top+t.bottom)}),(0,o.jsx)("defs",{children:(0,o.jsx)("clipPath",{id:"clipath",children:(0,o.jsx)("rect",{width:p.width-(t.left+t.right),height:p.height-(t.top+t.bottom),x:"0",y:"0"})})}),!(null===x&&null===r)&&(0,o.jsxs)("g",{id:"svggraph",clipPath:"url(#clipath)",width:p.width-(t.left+t.right),height:p.height-(t.top+t.bottom),transform:"translate(".concat(t.left,", ").concat(t.top,")"),children:[x.map(((e,t)=>(0,o.jsx)(g,{xScale:j.x,yScale:j.y,plots:e},t.toString()))),y?Object.entries(y).map((e=>{let[t,i]=e;return i.coordinates?"Solid"===i.style?(0,o.jsx)(A,{xScale:j.x,yScale:j.y,coordinates:i.coordinates,color:i.color},t):(0,o.jsx)(g,{xScale:j.x,yScale:j.y,color:i.color,plots:i.coordinates},t):null})):null]}),(0,o.jsx)(c,{type:"Graph",yScale:j.y,dimensions:p,margins:t,colors:h,label:!!e.axisLabel.y&&e.axisLabel.y,notation:e.notation}),(0,o.jsx)(m,{xScale:j.x,dimensions:p,margins:t,colors:h,label:!!e.axisLabel.x&&e.axisLabel.x,notation:e.notation}),(0,o.jsx)(l,{width:p.width-(t.left+t.right),height:p.height-(t.top+t.bottom),stroke:h.text,margins:t})]}),(0,o.jsx)(d,{data:s})]})};var u=i(913),y=i(197),f=i(935);const j=e=>{const t=e.url+"/visualizations/"+e.index;return(0,o.jsxs)("div",{className:"visualization__footer",children:[(0,o.jsx)("div",{className:"visualization-footer__item-left",children:(0,o.jsx)("input",{className:"visualization-footer__item visualization-footer__button-fullscreen",onClick:e.handleClick,value:e.isFullscreen?"zoom_in_map":"zoom_out_map",type:"button"})}),e.isOnGoingExperiment?null:(0,o.jsxs)("a",{href:t,target:"_blank",rel:"noreferrer",className:"visualization-footer__item visualization-footer__dl",children:[(0,o.jsx)("span",{className:"visualization-footer__dl-icon",children:"download"}),"Download data (.json)"]})]})},b=e=>{const t={top:30,right:25,bottom:100,left:125},i={text:"#ADADAD",background:"#1B1A1A",stick:"#ADADAD47"},a=e.data,[s,l]=(0,n.useState)(!1),c=(0,n.useRef)(null),m=(0,n.useMemo)((()=>({x:{min:"undefined"!==a.xmin&&!isNaN(parseFloat(a.xmin))&&parseFloat(a.xmin),max:"undefined"!==a.xmax&&!isNaN(parseFloat(a.xmax))&&parseFloat(a.xmax)},y:{min:"undefined"!==a.ymin&&!isNaN(parseFloat(a.ymin))&&parseFloat(a.ymin),max:"undefined"!==a.ymax&&!isNaN(parseFloat(a.ymax))&&parseFloat(a.ymax)}})),[a.xmin,a.xmax,a.ymin,a.ymax]),[x,d]=(0,n.useState)({width:0,height:window.innerHeight*(s?.8:.7)}),A=()=>{l(!s)};(0,n.useEffect)((()=>{const e=e=>{"Escape"===e.key&&A()};return s&&window.addEventListener("keyup",e),()=>{window.removeEventListener("keyup",e)}}),[s]),(0,n.useEffect)((()=>{const e=c.current,t=new ResizeObserver((e=>{const t=e[0];t.contentRect.width!==x.width&&d({width:t.contentRect.width,height:window.innerHeight*(s?.8:.7)})}));return t.observe(e),()=>t.unobserve(e)}),[x,s,c]);const g=(0,n.useMemo)((()=>{if(0===a.displayedData.length)return a.displayedData;if(!1===m.x.min&&!1===m.x.max&&!1===m.y.min&&!1===m.y.max)return a.displayedData;if("Histogram"===a.type){const e=e=>(!1===m.x.min||e>=m.x.min)&&(!1===m.x.max||e<=m.x.max);return a.displayedData.filter(e)}return a.type,a.displayedData}),[a.displayedData,m,a.type]);return(0,o.jsxs)("article",{className:"visualization"+(s?" visualization--fullscreen":"")+" visualization--"+a.type.toLowerCase(),children:[(0,o.jsxs)("div",{className:"visualization__frame",children:[s?(0,o.jsx)(f.a2,{handleClick:A,classes:"visualization__close-button",icon:"close"}):null,(0,o.jsxs)("div",{className:"visualization__inner-padding",children:[(0,o.jsxs)("div",{className:"visualization__header",children:[(0,o.jsx)("h2",{className:"visualization__title",children:a.title}),(0,o.jsxs)("p",{className:"visualization__participants-number",children:[(0,o.jsx)("span",{children:a.contributions_total?a.contributions_total:0}),(0,o.jsx)("span",{className:"visualization__participants-icon",children:"group"})]})]}),(0,o.jsx)("div",{className:"visualization__wrapper",ref:c,children:{"Single Number":(0,o.jsx)(r,{unit:a.unit,data:g,notation:a.notation,isOnGoingExperiment:e.isOnGoingExperiment}),Histogram:(0,o.jsx)(h,{dimensions:x,domain:m,bins:a.bins,colors:i,axisLabel:{x:a.labelx,y:a.labely},notation:a.notation,data:g,margins:t}),Graph:(0,o.jsx)(p,{dimensions:x,isOnGoingExperiment:e.isOnGoingExperiment,colors:i,domain:m,axisLabel:{x:a.labelx,y:a.labely},notation:a.notation,data:g,lines:a.lines,margins:t})}[a.type]})]}),a.description?(0,o.jsx)("p",{className:"visualization__description",children:a.description}):null]}),(0,o.jsx)(j,{isFullscreen:s,handleClick:A,isOnGoingExperiment:e.isOnGoingExperiment,index:e.index,url:e.url})]})};var N=i(68),w=i(141);const E=e=>{const[t,i]=(0,n.useState)({isLoaded:!1,error:!1,data:null}),a=(0,n.useContext)(w.cr).setIsAppListening;return(0,n.useEffect)((()=>{if(!e.isOnGoingExperiment&&t.isLoaded)return;const n=e=>{fetch(e,{credentials:"include"}).then((e=>e.json())).then((e=>{e.hasOwnProperty("error")?i({...t,isLoaded:!0,error:e.error}):"closing"===e?a(!1):i({isLoaded:!0,error:!1,data:e})}),(e=>{i({...t,isLoaded:!0,error:String(e)})}))};if(e.isOnGoingExperiment){const t=setInterval(n,1e3,e.fetchURL);return()=>{clearInterval(t)}}n(e.fetchURL)}),[t,e,a]),t.isLoaded?t.error?(0,o.jsx)(u.A,{type:"error",message:t.error}):(0,o.jsxs)(o.Fragment,{children:[(0,o.jsx)(N.h,{header:e.title,content:t.data.title,icon:!e.isOnGoingExperiment&&"square_foot",image:!!e.isOnGoingExperiment&&"data:image/gif;base64,R0lGODlhFAAIANU2AIFGGy8gFiEaFOJzIsZmH2Y5GUosFoJHHCEZFD0nFhoWEyIaFdRtIHNAGqtaHiEaFXpDG2w8Ge96Ii4fFTwmFS8gFYFHHG8+Gp1UHSgdFRsXFBwYFBwXFI9NHDklFpxUHVgzGKhZHj0mFkQqFioeFVk0GHlDGqpaHl82GDAgFUEoFhoXFHtDG209GmE4GUMpFnRAGlEwFz8nFlIwGPB6IhMTE////wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh/wtYTVAgRGF0YVhNUDw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDo2OTcwQzBEMkY1NEFFRDExQkU4QUQ1NDI0RTY4RTdENiIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpBMUExRUYyMDRBRjcxMUVEQUNBNkYzMUM5RTI3NjlCRSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpBMUExRUYxRjRBRjcxMUVEQUNBNkYzMUM5RTI3NjlCRSIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ1M2IChXaW5kb3dzKSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjZBNzBDMEQyRjU0QUVEMTFCRThBRDU0MjRFNjhFN0Q2IiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjY5NzBDMEQyRjU0QUVEMTFCRThBRDU0MjRFNjhFN0Q2Ii8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+Af/+/fz7+vn49/b19PPy8fDv7u3s6+rp6Ofm5eTj4uHg397d3Nva2djX1tXU09LR0M/OzczLysnIx8bFxMPCwcC/vr28u7q5uLe2tbSzsrGwr66trKuqqainpqWko6KhoJ+enZybmpmYl5aVlJOSkZCPjo2Mi4qJiIeGhYSDgoGAf359fHt6eXh3dnV0c3JxcG9ubWxramloZ2ZlZGNiYWBfXl1cW1pZWFdWVVRTUlFQT05NTEtKSUhHRkVEQ0JBQD8+PTw7Ojk4NzY1NDMyMTAvLi0sKyopKCcmJSQjIiEgHx4dHBsaGRgXFhUUExIREA8ODQwLCgkIBwYFBAMCAQAAIfkEBQoANgAsAAAAABQACAAABhLAmnBILBqPyKRyyWw6n9DoMQgAIfkEBQoANgAsAAAAAAEAAQAABgNAWxAAIfkEBQoANgAsAAAAAAEAAQAABgNAWxAAIfkEBQoANgAsAgACAAUABAAABhNA20O0EEIALFsFALAsOJeDyxYEACH5BAUKADYALAIAAgAFAAQAAAYTQFugEBAOaAObgUaTBAQEWsgWBAAh+QQFCgA2ACwFAAIABwAEAAAGF0Cb0LZQbYaLw8Fk89gqAIDlJFxFAKUgACH5BAUKADYALAUAAgAHAAQAAAYWQJvQFigIhgEajUFL2AxKiUMoINA+QQAh+QQFCgA2ACwLAAIABwAEAAAGFkCb0EaSaYapw+FCE44AgANG+GgAZkEAIfkEBQoANgAsDgACAAQABAAABg9AW6IgMNBoBNiRFmDQOkEAIfkEBQoANgAsAgACABAABAAABixAG4KCsBmHCqMtQ1EgIADIEQBoGCfUCJaasW0BxhcVoGgBUEZFBAA6NgCxIAA7"}),(0,o.jsx)("p",{className:"experiment__description",children:t.data.description}),t.data.visualizations.map(((t,i)=>(0,o.jsx)(b,{index:i,url:e.fetchURL,isOnGoingExperiment:e.isOnGoingExperiment,data:t},t.title+"_"+i.toString())))]}):(0,o.jsx)(y.A,{})}},913:(e,t,i)=>{i.d(t,{A:()=>a});i(43);var n=i(579);const a=e=>(0,n.jsx)("p",{className:"message message--"+(e.type?e.type:"info"),children:e.message})},68:(e,t,i)=>{i.d(t,{h:()=>r,r:()=>o});var n=i(43),a=i(141),s=i(579);const o=e=>(0,s.jsxs)("div",{className:"title",children:[(0,s.jsxs)("p",{className:"title__header",children:[e.header,e.icon?(0,s.jsx)("span",{className:"title__icon",children:e.icon}):null,e.image?(0,s.jsx)("img",{className:"title__image",alt:"",src:e.image}):null]}),(0,s.jsx)("h1",{className:"title__content",children:e.content})]}),r=e=>{const t=(0,n.useContext)(a.cr).isAppListening;return document.title=(t?"\ud83d\udfe9":"\ud83d\udfe7")+" phyphox, "+e.content,(0,s.jsx)(o,{header:e.header,content:e.content,image:e.image,icon:e.icon})}}}]);
//# sourceMappingURL=175.17c7bedb.chunk.js.map