/*! modernizr 3.5.0 (Custom Build) | MIT *
 * https://modernizr.com/download/?-boxshadow-cssanimations-inputtypes-setclasses !*/
!function(e,t,n){function r(e,t){return typeof e===t}function i(){var e,t,n,i,o,s,l;for(var a in w)if(w.hasOwnProperty(a)){if(e=[],t=w[a],t.name&&(e.push(t.name.toLowerCase()),t.options&&t.options.aliases&&t.options.aliases.length))for(n=0;n<t.options.aliases.length;n++)e.push(t.options.aliases[n].toLowerCase());for(i=r(t.fn,"function")?t.fn():t.fn,o=0;o<e.length;o++)s=e[o],l=s.split("."),1===l.length?Modernizr[l[0]]=i:(!Modernizr[l[0]]||Modernizr[l[0]]instanceof Boolean||(Modernizr[l[0]]=new Boolean(Modernizr[l[0]])),Modernizr[l[0]][l[1]]=i),C.push((i?"":"no-")+l.join("-"))}}function o(e){var t=b.className,n=Modernizr._config.classPrefix||"";if(x&&(t=t.baseVal),Modernizr._config.enableJSClass){var r=new RegExp("(^|\\s)"+n+"no-js(\\s|$)");t=t.replace(r,"$1"+n+"js$2")}Modernizr._config.enableClasses&&(t+=" "+n+e.join(" "+n),x?b.className.baseVal=t:b.className=t)}function s(){return"function"!=typeof t.createElement?t.createElement(arguments[0]):x?t.createElementNS.call(t,"http://www.w3.org/2000/svg",arguments[0]):t.createElement.apply(t,arguments)}function l(e,t){return!!~(""+e).indexOf(t)}function a(e){return e.replace(/([a-z])-([a-z])/g,function(e,t,n){return t+n.toUpperCase()}).replace(/^-/,"")}function u(e,t){return function(){return e.apply(t,arguments)}}function f(e,t,n){var i;for(var o in e)if(e[o]in t)return n===!1?e[o]:(i=t[e[o]],r(i,"function")?u(i,n||t):i);return!1}function d(e){return e.replace(/([A-Z])/g,function(e,t){return"-"+t.toLowerCase()}).replace(/^ms-/,"-ms-")}function p(t,n,r){var i;if("getComputedStyle"in e){i=getComputedStyle.call(e,t,n);var o=e.console;if(null!==i)r&&(i=i.getPropertyValue(r));else if(o){var s=o.error?"error":"log";o[s].call(o,"getComputedStyle returning null, its possible modernizr test results are inaccurate")}}else i=!n&&t.currentStyle&&t.currentStyle[r];return i}function c(){var e=t.body;return e||(e=s(x?"svg":"body"),e.fake=!0),e}function m(e,n,r,i){var o,l,a,u,f="modernizr",d=s("div"),p=c();if(parseInt(r,10))for(;r--;)a=s("div"),a.id=i?i[r]:f+(r+1),d.appendChild(a);return o=s("style"),o.type="text/css",o.id="s"+f,(p.fake?p:d).appendChild(o),p.appendChild(d),o.styleSheet?o.styleSheet.cssText=e:o.appendChild(t.createTextNode(e)),d.id=f,p.fake&&(p.style.background="",p.style.overflow="hidden",u=b.style.overflow,b.style.overflow="hidden",b.appendChild(p)),l=n(d,e),p.fake?(p.parentNode.removeChild(p),b.style.overflow=u,b.offsetHeight):d.parentNode.removeChild(d),!!l}function y(t,r){var i=t.length;if("CSS"in e&&"supports"in e.CSS){for(;i--;)if(e.CSS.supports(d(t[i]),r))return!0;return!1}if("CSSSupportsRule"in e){for(var o=[];i--;)o.push("("+d(t[i])+":"+r+")");return o=o.join(" or "),m("@supports ("+o+") { #modernizr { position: absolute; } }",function(e){return"absolute"==p(e,null,"position")})}return n}function h(e,t,i,o){function u(){d&&(delete A.style,delete A.modElem)}if(o=r(o,"undefined")?!1:o,!r(i,"undefined")){var f=y(e,i);if(!r(f,"undefined"))return f}for(var d,p,c,m,h,v=["modernizr","tspan","samp"];!A.style&&v.length;)d=!0,A.modElem=s(v.shift()),A.style=A.modElem.style;for(c=e.length,p=0;c>p;p++)if(m=e[p],h=A.style[m],l(m,"-")&&(m=a(m)),A.style[m]!==n){if(o||r(i,"undefined"))return u(),"pfx"==t?m:!0;try{A.style[m]=i}catch(g){}if(A.style[m]!=h)return u(),"pfx"==t?m:!0}return u(),!1}function v(e,t,n,i,o){var s=e.charAt(0).toUpperCase()+e.slice(1),l=(e+" "+N.join(s+" ")+s).split(" ");return r(t,"string")||r(t,"undefined")?h(l,t,i,o):(l=(e+" "+E.join(s+" ")+s).split(" "),f(l,t,n))}function g(e,t,r){return v(e,n,n,t,r)}var C=[],w=[],S={_version:"3.5.0",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(e,t){var n=this;setTimeout(function(){t(n[e])},0)},addTest:function(e,t,n){w.push({name:e,fn:t,options:n})},addAsyncTest:function(e){w.push({name:null,fn:e})}},Modernizr=function(){};Modernizr.prototype=S,Modernizr=new Modernizr;var b=t.documentElement,x="svg"===b.nodeName.toLowerCase(),_=s("input"),k="search tel url email datetime date month week time datetime-local number range color".split(" "),P={};Modernizr.inputtypes=function(e){for(var r,i,o,s=e.length,l="1)",a=0;s>a;a++)_.setAttribute("type",r=e[a]),o="text"!==_.type&&"style"in _,o&&(_.value=l,_.style.cssText="position:absolute;visibility:hidden;",/^range$/.test(r)&&_.style.WebkitAppearance!==n?(b.appendChild(_),i=t.defaultView,o=i.getComputedStyle&&"textfield"!==i.getComputedStyle(_,null).WebkitAppearance&&0!==_.offsetHeight,b.removeChild(_)):/^(search|tel)$/.test(r)||(o=/^(url|email)$/.test(r)?_.checkValidity&&_.checkValidity()===!1:_.value!=l)),P[e[a]]=!!o;return P}(k);var z="Moz O ms Webkit",E=S._config.usePrefixes?z.toLowerCase().split(" "):[];S._domPrefixes=E;var N=S._config.usePrefixes?z.split(" "):[];S._cssomPrefixes=N;var T={elem:s("modernizr")};Modernizr._q.push(function(){delete T.elem});var A={style:T.elem.style};Modernizr._q.unshift(function(){delete A.style}),S.testAllProps=v,S.testAllProps=g,Modernizr.addTest("cssanimations",g("animationName","a",!0)),Modernizr.addTest("boxshadow",g("boxShadow","1px 1px",!0)),i(),o(C),delete S.addTest,delete S.addAsyncTest;for(var j=0;j<Modernizr._q.length;j++)Modernizr._q[j]();e.Modernizr=Modernizr}(window,document);