"use strict";!function(){function d(e,t,n,i){document.getElementById("valX").innerHTML='<strong class="font-weight-bold">x : </strong>&nbsp;'+e,document.getElementById("valY").innerHTML='<strong class="font-weight-bold">y : </strong>&nbsp;'+t,document.getElementById("valW").innerHTML='<strong class="font-weight-bold">width : </strong>&nbsp;'+n,document.getElementById("valH").innerHTML='<strong class="font-weight-bold">height : </strong>&nbsp;'+i}function a(e){return!isNaN(parseInt(e))&&""!==e}function r(e){var t=e.value;return"SELECT"!==e.tagName?a(t)?(e.classList.remove("is-danger"),t):(""!==t&&e.classList.add("is-danger"),null):t}function u(t,n,i){return function(){var e=i.map(r);t.options[n]={width:Number(e[0]),height:Number(e[1]),unit:e[2]},"%"===e[2]&&t.options.convertToPixels(t.cropperEl),t.reset()}}window.onload=function(){var n=new Croppr("#croppr",{startSize:[80,80,"%"],onCropMove:function(e){d(e.x,e.y,e.width,e.height)}}),i=document.getElementById("cb-ratio"),s=document.getElementById("input-ratio"),e=(i.addEventListener("change",function(e){e.target.checked?(s.disabled=!1,a(e=s.value)?(s.classList.remove("is-danger"),n.options.aspectRatio=Number(e),n.reset()):""!==e&&s.classList.add("is-danger")):(n.options.aspectRatio=null,s.disabled=!0,s.classList.remove("is-danger"),n.reset())}),s.addEventListener("input",function(e){var t;i.checked&&(a(t=s.value)?(s.classList.remove("is-danger"),t=Number(t),n.options.aspectRatio=t,n.reset()):s.classList.add("is-danger"))}),document.getElementById("max-checkbox")),t=[document.getElementById("max-input-width"),document.getElementById("max-input-height"),document.getElementById("max-input-unit")],e=(e.addEventListener("change",function(e){e.target.checked?(t.map(function(e){e.disabled=!1}),e=t.map(r),n.options.maxSize={width:Number(e[0]),height:Number(e[1]),unit:e[2]}):(n.options.maxSize={width:null,height:null},t.map(function(e){e.disabled=!0,e.classList.remove("is-danger")})),n.reset()}),t.map(function(e){e.addEventListener("input",u(n,"maxSize",t))}),document.getElementById("min-checkbox")),o=[document.getElementById("min-input-width"),document.getElementById("min-input-height"),document.getElementById("min-input-unit")],e=(e.addEventListener("change",function(e){e.target.checked?(o.map(function(e){e.disabled=!1}),e=o.map(r),n.options.minSize={width:Number(e[0]),height:Number(e[1]),unit:e[2]}):(n.options.minSize={width:null,height:null},o.map(function(e){e.disabled=!0,e.classList.remove("is-danger")})),n.reset()}),o.map(function(e){e.addEventListener("input",u(n,"minSize",o))}),n.getValue());d(e.x,e.y,e.width,e.height)}}();