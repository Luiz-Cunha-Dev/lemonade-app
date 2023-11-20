/*! For license information please see firstAccess.js.LICENSE.txt */
(()=>{var t={9606:()=>{var t=localStorage.getItem("darkMode"),e=document.getElementById("toggle-button"),n="./app/views/pages/assets/svgs/sun.svg",r="./app/views/pages/assets/svgs/moon.svg";"true"===t||null===t?(document.body.classList.add("dark-mode"),e.src=n):(document.body.classList.add("light-mode"),e.src=r),e.addEventListener("click",(function(){document.body.classList.toggle("dark-mode"),document.body.classList.toggle("light-mode"),document.body.classList.contains("dark-mode")?(localStorage.setItem("darkMode","true"),e.src=n):(localStorage.setItem("darkMode","false"),e.src=r)}))}},e={};function n(r){var o=e[r];if(void 0!==o)return o.exports;var i=e[r]={exports:{}};return t[r](i,i.exports,n),i.exports}(()=>{"use strict";function t(t,e){return function(){return t.apply(e,arguments)}}n(9606);const{toString:e}=Object.prototype,{getPrototypeOf:r}=Object,o=(i=Object.create(null),t=>{const n=e.call(t);return i[n]||(i[n]=n.slice(8,-1).toLowerCase())});var i;const s=t=>(t=t.toLowerCase(),e=>o(e)===t),a=t=>e=>typeof e===t,{isArray:c}=Array,u=a("undefined"),l=s("ArrayBuffer"),f=a("string"),d=a("function"),h=a("number"),p=t=>null!==t&&"object"==typeof t,m=t=>{if("object"!==o(t))return!1;const e=r(t);return!(null!==e&&e!==Object.prototype&&null!==Object.getPrototypeOf(e)||Symbol.toStringTag in t||Symbol.iterator in t)},y=s("Date"),g=s("File"),b=s("Blob"),v=s("FileList"),w=s("URLSearchParams");function E(t,e,{allOwnKeys:n=!1}={}){if(null==t)return;let r,o;if("object"!=typeof t&&(t=[t]),c(t))for(r=0,o=t.length;r<o;r++)e.call(null,t[r],r,t);else{const o=n?Object.getOwnPropertyNames(t):Object.keys(t),i=o.length;let s;for(r=0;r<i;r++)s=o[r],e.call(null,t[s],s,t)}}function O(t,e){e=e.toLowerCase();const n=Object.keys(t);let r,o=n.length;for(;o-- >0;)if(r=n[o],e===r.toLowerCase())return r;return null}const S="undefined"!=typeof globalThis?globalThis:"undefined"!=typeof self?self:"undefined"!=typeof window?window:global,L=t=>!u(t)&&t!==S,R=(x="undefined"!=typeof Uint8Array&&r(Uint8Array),t=>x&&t instanceof x);var x;const A=s("HTMLFormElement"),T=(({hasOwnProperty:t})=>(e,n)=>t.call(e,n))(Object.prototype),j=s("RegExp"),N=(t,e)=>{const n=Object.getOwnPropertyDescriptors(t),r={};E(n,((n,o)=>{let i;!1!==(i=e(n,o,t))&&(r[o]=i||n)})),Object.defineProperties(t,r)},P="abcdefghijklmnopqrstuvwxyz",C="0123456789",_={DIGIT:C,ALPHA:P,ALPHA_DIGIT:P+P.toUpperCase()+C},F=s("AsyncFunction"),k={isArray:c,isArrayBuffer:l,isBuffer:function(t){return null!==t&&!u(t)&&null!==t.constructor&&!u(t.constructor)&&d(t.constructor.isBuffer)&&t.constructor.isBuffer(t)},isFormData:t=>{let e;return t&&("function"==typeof FormData&&t instanceof FormData||d(t.append)&&("formdata"===(e=o(t))||"object"===e&&d(t.toString)&&"[object FormData]"===t.toString()))},isArrayBufferView:function(t){let e;return e="undefined"!=typeof ArrayBuffer&&ArrayBuffer.isView?ArrayBuffer.isView(t):t&&t.buffer&&l(t.buffer),e},isString:f,isNumber:h,isBoolean:t=>!0===t||!1===t,isObject:p,isPlainObject:m,isUndefined:u,isDate:y,isFile:g,isBlob:b,isRegExp:j,isFunction:d,isStream:t=>p(t)&&d(t.pipe),isURLSearchParams:w,isTypedArray:R,isFileList:v,forEach:E,merge:function t(){const{caseless:e}=L(this)&&this||{},n={},r=(r,o)=>{const i=e&&O(n,o)||o;m(n[i])&&m(r)?n[i]=t(n[i],r):m(r)?n[i]=t({},r):c(r)?n[i]=r.slice():n[i]=r};for(let t=0,e=arguments.length;t<e;t++)arguments[t]&&E(arguments[t],r);return n},extend:(e,n,r,{allOwnKeys:o}={})=>(E(n,((n,o)=>{r&&d(n)?e[o]=t(n,r):e[o]=n}),{allOwnKeys:o}),e),trim:t=>t.trim?t.trim():t.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,""),stripBOM:t=>(65279===t.charCodeAt(0)&&(t=t.slice(1)),t),inherits:(t,e,n,r)=>{t.prototype=Object.create(e.prototype,r),t.prototype.constructor=t,Object.defineProperty(t,"super",{value:e.prototype}),n&&Object.assign(t.prototype,n)},toFlatObject:(t,e,n,o)=>{let i,s,a;const c={};if(e=e||{},null==t)return e;do{for(i=Object.getOwnPropertyNames(t),s=i.length;s-- >0;)a=i[s],o&&!o(a,t,e)||c[a]||(e[a]=t[a],c[a]=!0);t=!1!==n&&r(t)}while(t&&(!n||n(t,e))&&t!==Object.prototype);return e},kindOf:o,kindOfTest:s,endsWith:(t,e,n)=>{t=String(t),(void 0===n||n>t.length)&&(n=t.length),n-=e.length;const r=t.indexOf(e,n);return-1!==r&&r===n},toArray:t=>{if(!t)return null;if(c(t))return t;let e=t.length;if(!h(e))return null;const n=new Array(e);for(;e-- >0;)n[e]=t[e];return n},forEachEntry:(t,e)=>{const n=(t&&t[Symbol.iterator]).call(t);let r;for(;(r=n.next())&&!r.done;){const n=r.value;e.call(t,n[0],n[1])}},matchAll:(t,e)=>{let n;const r=[];for(;null!==(n=t.exec(e));)r.push(n);return r},isHTMLForm:A,hasOwnProperty:T,hasOwnProp:T,reduceDescriptors:N,freezeMethods:t=>{N(t,((e,n)=>{if(d(t)&&-1!==["arguments","caller","callee"].indexOf(n))return!1;const r=t[n];d(r)&&(e.enumerable=!1,"writable"in e?e.writable=!1:e.set||(e.set=()=>{throw Error("Can not rewrite read-only method '"+n+"'")}))}))},toObjectSet:(t,e)=>{const n={},r=t=>{t.forEach((t=>{n[t]=!0}))};return c(t)?r(t):r(String(t).split(e)),n},toCamelCase:t=>t.toLowerCase().replace(/[-_\s]([a-z\d])(\w*)/g,(function(t,e,n){return e.toUpperCase()+n})),noop:()=>{},toFiniteNumber:(t,e)=>(t=+t,Number.isFinite(t)?t:e),findKey:O,global:S,isContextDefined:L,ALPHABET:_,generateString:(t=16,e=_.ALPHA_DIGIT)=>{let n="";const{length:r}=e;for(;t--;)n+=e[Math.random()*r|0];return n},isSpecCompliantForm:function(t){return!!(t&&d(t.append)&&"FormData"===t[Symbol.toStringTag]&&t[Symbol.iterator])},toJSONObject:t=>{const e=new Array(10),n=(t,r)=>{if(p(t)){if(e.indexOf(t)>=0)return;if(!("toJSON"in t)){e[r]=t;const o=c(t)?[]:{};return E(t,((t,e)=>{const i=n(t,r+1);!u(i)&&(o[e]=i)})),e[r]=void 0,o}}return t};return n(t,0)},isAsyncFn:F,isThenable:t=>t&&(p(t)||d(t))&&d(t.then)&&d(t.catch)};function B(t,e,n,r,o){Error.call(this),Error.captureStackTrace?Error.captureStackTrace(this,this.constructor):this.stack=(new Error).stack,this.message=t,this.name="AxiosError",e&&(this.code=e),n&&(this.config=n),r&&(this.request=r),o&&(this.response=o)}k.inherits(B,Error,{toJSON:function(){return{message:this.message,name:this.name,description:this.description,number:this.number,fileName:this.fileName,lineNumber:this.lineNumber,columnNumber:this.columnNumber,stack:this.stack,config:k.toJSONObject(this.config),code:this.code,status:this.response&&this.response.status?this.response.status:null}}});const U=B.prototype,D={};["ERR_BAD_OPTION_VALUE","ERR_BAD_OPTION","ECONNABORTED","ETIMEDOUT","ERR_NETWORK","ERR_FR_TOO_MANY_REDIRECTS","ERR_DEPRECATED","ERR_BAD_RESPONSE","ERR_BAD_REQUEST","ERR_CANCELED","ERR_NOT_SUPPORT","ERR_INVALID_URL"].forEach((t=>{D[t]={value:t}})),Object.defineProperties(B,D),Object.defineProperty(U,"isAxiosError",{value:!0}),B.from=(t,e,n,r,o,i)=>{const s=Object.create(U);return k.toFlatObject(t,s,(function(t){return t!==Error.prototype}),(t=>"isAxiosError"!==t)),B.call(s,t.message,e,n,r,o),s.cause=t,s.name=t.name,i&&Object.assign(s,i),s};const I=B;function q(t){return k.isPlainObject(t)||k.isArray(t)}function M(t){return k.endsWith(t,"[]")?t.slice(0,-2):t}function z(t,e,n){return t?t.concat(e).map((function(t,e){return t=M(t),!n&&e?"["+t+"]":t})).join(n?".":""):e}const H=k.toFlatObject(k,{},null,(function(t){return/^is[A-Z]/.test(t)})),J=function(t,e,n){if(!k.isObject(t))throw new TypeError("target must be an object");e=e||new FormData;const r=(n=k.toFlatObject(n,{metaTokens:!0,dots:!1,indexes:!1},!1,(function(t,e){return!k.isUndefined(e[t])}))).metaTokens,o=n.visitor||u,i=n.dots,s=n.indexes,a=(n.Blob||"undefined"!=typeof Blob&&Blob)&&k.isSpecCompliantForm(e);if(!k.isFunction(o))throw new TypeError("visitor must be a function");function c(t){if(null===t)return"";if(k.isDate(t))return t.toISOString();if(!a&&k.isBlob(t))throw new I("Blob is not supported. Use a Buffer instead.");return k.isArrayBuffer(t)||k.isTypedArray(t)?a&&"function"==typeof Blob?new Blob([t]):Buffer.from(t):t}function u(t,n,o){let a=t;if(t&&!o&&"object"==typeof t)if(k.endsWith(n,"{}"))n=r?n:n.slice(0,-2),t=JSON.stringify(t);else if(k.isArray(t)&&function(t){return k.isArray(t)&&!t.some(q)}(t)||(k.isFileList(t)||k.endsWith(n,"[]"))&&(a=k.toArray(t)))return n=M(n),a.forEach((function(t,r){!k.isUndefined(t)&&null!==t&&e.append(!0===s?z([n],r,i):null===s?n:n+"[]",c(t))})),!1;return!!q(t)||(e.append(z(o,n,i),c(t)),!1)}const l=[],f=Object.assign(H,{defaultVisitor:u,convertValue:c,isVisitable:q});if(!k.isObject(t))throw new TypeError("data must be an object");return function t(n,r){if(!k.isUndefined(n)){if(-1!==l.indexOf(n))throw Error("Circular reference detected in "+r.join("."));l.push(n),k.forEach(n,(function(n,i){!0===(!(k.isUndefined(n)||null===n)&&o.call(e,n,k.isString(i)?i.trim():i,r,f))&&t(n,r?r.concat(i):[i])})),l.pop()}}(t),e};function G(t){const e={"!":"%21","'":"%27","(":"%28",")":"%29","~":"%7E","%20":"+","%00":"\0"};return encodeURIComponent(t).replace(/[!'()~]|%20|%00/g,(function(t){return e[t]}))}function W(t,e){this._pairs=[],t&&J(t,this,e)}const K=W.prototype;K.append=function(t,e){this._pairs.push([t,e])},K.toString=function(t){const e=t?function(e){return t.call(this,e,G)}:G;return this._pairs.map((function(t){return e(t[0])+"="+e(t[1])}),"").join("&")};const V=W;function $(t){return encodeURIComponent(t).replace(/%3A/gi,":").replace(/%24/g,"$").replace(/%2C/gi,",").replace(/%20/g,"+").replace(/%5B/gi,"[").replace(/%5D/gi,"]")}function X(t,e,n){if(!e)return t;const r=n&&n.encode||$,o=n&&n.serialize;let i;if(i=o?o(e,n):k.isURLSearchParams(e)?e.toString():new V(e,n).toString(r),i){const e=t.indexOf("#");-1!==e&&(t=t.slice(0,e)),t+=(-1===t.indexOf("?")?"?":"&")+i}return t}const Q=class{constructor(){this.handlers=[]}use(t,e,n){return this.handlers.push({fulfilled:t,rejected:e,synchronous:!!n&&n.synchronous,runWhen:n?n.runWhen:null}),this.handlers.length-1}eject(t){this.handlers[t]&&(this.handlers[t]=null)}clear(){this.handlers&&(this.handlers=[])}forEach(t){k.forEach(this.handlers,(function(e){null!==e&&t(e)}))}},Y={silentJSONParsing:!0,forcedJSONParsing:!0,clarifyTimeoutError:!1},Z={isBrowser:!0,classes:{URLSearchParams:"undefined"!=typeof URLSearchParams?URLSearchParams:V,FormData:"undefined"!=typeof FormData?FormData:null,Blob:"undefined"!=typeof Blob?Blob:null},isStandardBrowserEnv:(()=>{let t;return("undefined"==typeof navigator||"ReactNative"!==(t=navigator.product)&&"NativeScript"!==t&&"NS"!==t)&&"undefined"!=typeof window&&"undefined"!=typeof document})(),isStandardBrowserWebWorkerEnv:"undefined"!=typeof WorkerGlobalScope&&self instanceof WorkerGlobalScope&&"function"==typeof self.importScripts,protocols:["http","https","file","blob","url","data"]},tt=function(t){function e(t,n,r,o){let i=t[o++];const s=Number.isFinite(+i),a=o>=t.length;return i=!i&&k.isArray(r)?r.length:i,a?(k.hasOwnProp(r,i)?r[i]=[r[i],n]:r[i]=n,!s):(r[i]&&k.isObject(r[i])||(r[i]=[]),e(t,n,r[i],o)&&k.isArray(r[i])&&(r[i]=function(t){const e={},n=Object.keys(t);let r;const o=n.length;let i;for(r=0;r<o;r++)i=n[r],e[i]=t[i];return e}(r[i])),!s)}if(k.isFormData(t)&&k.isFunction(t.entries)){const n={};return k.forEachEntry(t,((t,r)=>{e(function(t){return k.matchAll(/\w+|\[(\w*)]/g,t).map((t=>"[]"===t[0]?"":t[1]||t[0]))}(t),r,n,0)})),n}return null},et={transitional:Y,adapter:["xhr","http"],transformRequest:[function(t,e){const n=e.getContentType()||"",r=n.indexOf("application/json")>-1,o=k.isObject(t);if(o&&k.isHTMLForm(t)&&(t=new FormData(t)),k.isFormData(t))return r&&r?JSON.stringify(tt(t)):t;if(k.isArrayBuffer(t)||k.isBuffer(t)||k.isStream(t)||k.isFile(t)||k.isBlob(t))return t;if(k.isArrayBufferView(t))return t.buffer;if(k.isURLSearchParams(t))return e.setContentType("application/x-www-form-urlencoded;charset=utf-8",!1),t.toString();let i;if(o){if(n.indexOf("application/x-www-form-urlencoded")>-1)return function(t,e){return J(t,new Z.classes.URLSearchParams,Object.assign({visitor:function(t,e,n,r){return Z.isNode&&k.isBuffer(t)?(this.append(e,t.toString("base64")),!1):r.defaultVisitor.apply(this,arguments)}},e))}(t,this.formSerializer).toString();if((i=k.isFileList(t))||n.indexOf("multipart/form-data")>-1){const e=this.env&&this.env.FormData;return J(i?{"files[]":t}:t,e&&new e,this.formSerializer)}}return o||r?(e.setContentType("application/json",!1),function(t,e,n){if(k.isString(t))try{return(0,JSON.parse)(t),k.trim(t)}catch(t){if("SyntaxError"!==t.name)throw t}return(0,JSON.stringify)(t)}(t)):t}],transformResponse:[function(t){const e=this.transitional||et.transitional,n=e&&e.forcedJSONParsing,r="json"===this.responseType;if(t&&k.isString(t)&&(n&&!this.responseType||r)){const n=!(e&&e.silentJSONParsing)&&r;try{return JSON.parse(t)}catch(t){if(n){if("SyntaxError"===t.name)throw I.from(t,I.ERR_BAD_RESPONSE,this,null,this.response);throw t}}}return t}],timeout:0,xsrfCookieName:"XSRF-TOKEN",xsrfHeaderName:"X-XSRF-TOKEN",maxContentLength:-1,maxBodyLength:-1,env:{FormData:Z.classes.FormData,Blob:Z.classes.Blob},validateStatus:function(t){return t>=200&&t<300},headers:{common:{Accept:"application/json, text/plain, */*","Content-Type":void 0}}};k.forEach(["delete","get","head","post","put","patch"],(t=>{et.headers[t]={}}));const nt=et,rt=k.toObjectSet(["age","authorization","content-length","content-type","etag","expires","from","host","if-modified-since","if-unmodified-since","last-modified","location","max-forwards","proxy-authorization","referer","retry-after","user-agent"]),ot=Symbol("internals");function it(t){return t&&String(t).trim().toLowerCase()}function st(t){return!1===t||null==t?t:k.isArray(t)?t.map(st):String(t)}function at(t,e,n,r,o){return k.isFunction(r)?r.call(this,e,n):(o&&(e=n),k.isString(e)?k.isString(r)?-1!==e.indexOf(r):k.isRegExp(r)?r.test(e):void 0:void 0)}class ct{constructor(t){t&&this.set(t)}set(t,e,n){const r=this;function o(t,e,n){const o=it(e);if(!o)throw new Error("header name must be a non-empty string");const i=k.findKey(r,o);(!i||void 0===r[i]||!0===n||void 0===n&&!1!==r[i])&&(r[i||e]=st(t))}const i=(t,e)=>k.forEach(t,((t,n)=>o(t,n,e)));return k.isPlainObject(t)||t instanceof this.constructor?i(t,e):k.isString(t)&&(t=t.trim())&&!/^[-_a-zA-Z0-9^`|~,!#$%&'*+.]+$/.test(t.trim())?i((t=>{const e={};let n,r,o;return t&&t.split("\n").forEach((function(t){o=t.indexOf(":"),n=t.substring(0,o).trim().toLowerCase(),r=t.substring(o+1).trim(),!n||e[n]&&rt[n]||("set-cookie"===n?e[n]?e[n].push(r):e[n]=[r]:e[n]=e[n]?e[n]+", "+r:r)})),e})(t),e):null!=t&&o(e,t,n),this}get(t,e){if(t=it(t)){const n=k.findKey(this,t);if(n){const t=this[n];if(!e)return t;if(!0===e)return function(t){const e=Object.create(null),n=/([^\s,;=]+)\s*(?:=\s*([^,;]+))?/g;let r;for(;r=n.exec(t);)e[r[1]]=r[2];return e}(t);if(k.isFunction(e))return e.call(this,t,n);if(k.isRegExp(e))return e.exec(t);throw new TypeError("parser must be boolean|regexp|function")}}}has(t,e){if(t=it(t)){const n=k.findKey(this,t);return!(!n||void 0===this[n]||e&&!at(0,this[n],n,e))}return!1}delete(t,e){const n=this;let r=!1;function o(t){if(t=it(t)){const o=k.findKey(n,t);!o||e&&!at(0,n[o],o,e)||(delete n[o],r=!0)}}return k.isArray(t)?t.forEach(o):o(t),r}clear(t){const e=Object.keys(this);let n=e.length,r=!1;for(;n--;){const o=e[n];t&&!at(0,this[o],o,t,!0)||(delete this[o],r=!0)}return r}normalize(t){const e=this,n={};return k.forEach(this,((r,o)=>{const i=k.findKey(n,o);if(i)return e[i]=st(r),void delete e[o];const s=t?function(t){return t.trim().toLowerCase().replace(/([a-z\d])(\w*)/g,((t,e,n)=>e.toUpperCase()+n))}(o):String(o).trim();s!==o&&delete e[o],e[s]=st(r),n[s]=!0})),this}concat(...t){return this.constructor.concat(this,...t)}toJSON(t){const e=Object.create(null);return k.forEach(this,((n,r)=>{null!=n&&!1!==n&&(e[r]=t&&k.isArray(n)?n.join(", "):n)})),e}[Symbol.iterator](){return Object.entries(this.toJSON())[Symbol.iterator]()}toString(){return Object.entries(this.toJSON()).map((([t,e])=>t+": "+e)).join("\n")}get[Symbol.toStringTag](){return"AxiosHeaders"}static from(t){return t instanceof this?t:new this(t)}static concat(t,...e){const n=new this(t);return e.forEach((t=>n.set(t))),n}static accessor(t){const e=(this[ot]=this[ot]={accessors:{}}).accessors,n=this.prototype;function r(t){const r=it(t);e[r]||(function(t,e){const n=k.toCamelCase(" "+e);["get","set","has"].forEach((r=>{Object.defineProperty(t,r+n,{value:function(t,n,o){return this[r].call(this,e,t,n,o)},configurable:!0})}))}(n,t),e[r]=!0)}return k.isArray(t)?t.forEach(r):r(t),this}}ct.accessor(["Content-Type","Content-Length","Accept","Accept-Encoding","User-Agent","Authorization"]),k.reduceDescriptors(ct.prototype,(({value:t},e)=>{let n=e[0].toUpperCase()+e.slice(1);return{get:()=>t,set(t){this[n]=t}}})),k.freezeMethods(ct);const ut=ct;function lt(t,e){const n=this||nt,r=e||n,o=ut.from(r.headers);let i=r.data;return k.forEach(t,(function(t){i=t.call(n,i,o.normalize(),e?e.status:void 0)})),o.normalize(),i}function ft(t){return!(!t||!t.__CANCEL__)}function dt(t,e,n){I.call(this,null==t?"canceled":t,I.ERR_CANCELED,e,n),this.name="CanceledError"}k.inherits(dt,I,{__CANCEL__:!0});const ht=dt,pt=Z.isStandardBrowserEnv?{write:function(t,e,n,r,o,i){const s=[];s.push(t+"="+encodeURIComponent(e)),k.isNumber(n)&&s.push("expires="+new Date(n).toGMTString()),k.isString(r)&&s.push("path="+r),k.isString(o)&&s.push("domain="+o),!0===i&&s.push("secure"),document.cookie=s.join("; ")},read:function(t){const e=document.cookie.match(new RegExp("(^|;\\s*)("+t+")=([^;]*)"));return e?decodeURIComponent(e[3]):null},remove:function(t){this.write(t,"",Date.now()-864e5)}}:{write:function(){},read:function(){return null},remove:function(){}};function mt(t,e){return t&&!/^([a-z][a-z\d+\-.]*:)?\/\//i.test(e)?function(t,e){return e?t.replace(/\/+$/,"")+"/"+e.replace(/^\/+/,""):t}(t,e):e}const yt=Z.isStandardBrowserEnv?function(){const t=/(msie|trident)/i.test(navigator.userAgent),e=document.createElement("a");let n;function r(n){let r=n;return t&&(e.setAttribute("href",r),r=e.href),e.setAttribute("href",r),{href:e.href,protocol:e.protocol?e.protocol.replace(/:$/,""):"",host:e.host,search:e.search?e.search.replace(/^\?/,""):"",hash:e.hash?e.hash.replace(/^#/,""):"",hostname:e.hostname,port:e.port,pathname:"/"===e.pathname.charAt(0)?e.pathname:"/"+e.pathname}}return n=r(window.location.href),function(t){const e=k.isString(t)?r(t):t;return e.protocol===n.protocol&&e.host===n.host}}():function(){return!0};function gt(t,e){let n=0;const r=function(t,e){t=t||10;const n=new Array(t),r=new Array(t);let o,i=0,s=0;return e=void 0!==e?e:1e3,function(a){const c=Date.now(),u=r[s];o||(o=c),n[i]=a,r[i]=c;let l=s,f=0;for(;l!==i;)f+=n[l++],l%=t;if(i=(i+1)%t,i===s&&(s=(s+1)%t),c-o<e)return;const d=u&&c-u;return d?Math.round(1e3*f/d):void 0}}(50,250);return o=>{const i=o.loaded,s=o.lengthComputable?o.total:void 0,a=i-n,c=r(a);n=i;const u={loaded:i,total:s,progress:s?i/s:void 0,bytes:a,rate:c||void 0,estimated:c&&s&&i<=s?(s-i)/c:void 0,event:o};u[e?"download":"upload"]=!0,t(u)}}const bt={http:null,xhr:"undefined"!=typeof XMLHttpRequest&&function(t){return new Promise((function(e,n){let r=t.data;const o=ut.from(t.headers).normalize(),i=t.responseType;let s,a;function c(){t.cancelToken&&t.cancelToken.unsubscribe(s),t.signal&&t.signal.removeEventListener("abort",s)}k.isFormData(r)&&(Z.isStandardBrowserEnv||Z.isStandardBrowserWebWorkerEnv?o.setContentType(!1):o.getContentType(/^\s*multipart\/form-data/)?k.isString(a=o.getContentType())&&o.setContentType(a.replace(/^\s*(multipart\/form-data);+/,"$1")):o.setContentType("multipart/form-data"));let u=new XMLHttpRequest;if(t.auth){const e=t.auth.username||"",n=t.auth.password?unescape(encodeURIComponent(t.auth.password)):"";o.set("Authorization","Basic "+btoa(e+":"+n))}const l=mt(t.baseURL,t.url);function f(){if(!u)return;const r=ut.from("getAllResponseHeaders"in u&&u.getAllResponseHeaders());!function(t,e,n){const r=n.config.validateStatus;n.status&&r&&!r(n.status)?e(new I("Request failed with status code "+n.status,[I.ERR_BAD_REQUEST,I.ERR_BAD_RESPONSE][Math.floor(n.status/100)-4],n.config,n.request,n)):t(n)}((function(t){e(t),c()}),(function(t){n(t),c()}),{data:i&&"text"!==i&&"json"!==i?u.response:u.responseText,status:u.status,statusText:u.statusText,headers:r,config:t,request:u}),u=null}if(u.open(t.method.toUpperCase(),X(l,t.params,t.paramsSerializer),!0),u.timeout=t.timeout,"onloadend"in u?u.onloadend=f:u.onreadystatechange=function(){u&&4===u.readyState&&(0!==u.status||u.responseURL&&0===u.responseURL.indexOf("file:"))&&setTimeout(f)},u.onabort=function(){u&&(n(new I("Request aborted",I.ECONNABORTED,t,u)),u=null)},u.onerror=function(){n(new I("Network Error",I.ERR_NETWORK,t,u)),u=null},u.ontimeout=function(){let e=t.timeout?"timeout of "+t.timeout+"ms exceeded":"timeout exceeded";const r=t.transitional||Y;t.timeoutErrorMessage&&(e=t.timeoutErrorMessage),n(new I(e,r.clarifyTimeoutError?I.ETIMEDOUT:I.ECONNABORTED,t,u)),u=null},Z.isStandardBrowserEnv){const e=yt(l)&&t.xsrfCookieName&&pt.read(t.xsrfCookieName);e&&o.set(t.xsrfHeaderName,e)}void 0===r&&o.setContentType(null),"setRequestHeader"in u&&k.forEach(o.toJSON(),(function(t,e){u.setRequestHeader(e,t)})),k.isUndefined(t.withCredentials)||(u.withCredentials=!!t.withCredentials),i&&"json"!==i&&(u.responseType=t.responseType),"function"==typeof t.onDownloadProgress&&u.addEventListener("progress",gt(t.onDownloadProgress,!0)),"function"==typeof t.onUploadProgress&&u.upload&&u.upload.addEventListener("progress",gt(t.onUploadProgress)),(t.cancelToken||t.signal)&&(s=e=>{u&&(n(!e||e.type?new ht(null,t,u):e),u.abort(),u=null)},t.cancelToken&&t.cancelToken.subscribe(s),t.signal&&(t.signal.aborted?s():t.signal.addEventListener("abort",s)));const d=function(t){const e=/^([-+\w]{1,25})(:?\/\/|:)/.exec(t);return e&&e[1]||""}(l);d&&-1===Z.protocols.indexOf(d)?n(new I("Unsupported protocol "+d+":",I.ERR_BAD_REQUEST,t)):u.send(r||null)}))}};k.forEach(bt,((t,e)=>{if(t){try{Object.defineProperty(t,"name",{value:e})}catch(t){}Object.defineProperty(t,"adapterName",{value:e})}}));const vt=t=>`- ${t}`,wt=t=>k.isFunction(t)||null===t||!1===t,Et=t=>{t=k.isArray(t)?t:[t];const{length:e}=t;let n,r;const o={};for(let i=0;i<e;i++){let e;if(n=t[i],r=n,!wt(n)&&(r=bt[(e=String(n)).toLowerCase()],void 0===r))throw new I(`Unknown adapter '${e}'`);if(r)break;o[e||"#"+i]=r}if(!r){const t=Object.entries(o).map((([t,e])=>`adapter ${t} `+(!1===e?"is not supported by the environment":"is not available in the build")));let n=e?t.length>1?"since :\n"+t.map(vt).join("\n"):" "+vt(t[0]):"as no adapter specified";throw new I("There is no suitable adapter to dispatch the request "+n,"ERR_NOT_SUPPORT")}return r};function Ot(t){if(t.cancelToken&&t.cancelToken.throwIfRequested(),t.signal&&t.signal.aborted)throw new ht(null,t)}function St(t){return Ot(t),t.headers=ut.from(t.headers),t.data=lt.call(t,t.transformRequest),-1!==["post","put","patch"].indexOf(t.method)&&t.headers.setContentType("application/x-www-form-urlencoded",!1),Et(t.adapter||nt.adapter)(t).then((function(e){return Ot(t),e.data=lt.call(t,t.transformResponse,e),e.headers=ut.from(e.headers),e}),(function(e){return ft(e)||(Ot(t),e&&e.response&&(e.response.data=lt.call(t,t.transformResponse,e.response),e.response.headers=ut.from(e.response.headers))),Promise.reject(e)}))}const Lt=t=>t instanceof ut?t.toJSON():t;function Rt(t,e){e=e||{};const n={};function r(t,e,n){return k.isPlainObject(t)&&k.isPlainObject(e)?k.merge.call({caseless:n},t,e):k.isPlainObject(e)?k.merge({},e):k.isArray(e)?e.slice():e}function o(t,e,n){return k.isUndefined(e)?k.isUndefined(t)?void 0:r(void 0,t,n):r(t,e,n)}function i(t,e){if(!k.isUndefined(e))return r(void 0,e)}function s(t,e){return k.isUndefined(e)?k.isUndefined(t)?void 0:r(void 0,t):r(void 0,e)}function a(n,o,i){return i in e?r(n,o):i in t?r(void 0,n):void 0}const c={url:i,method:i,data:i,baseURL:s,transformRequest:s,transformResponse:s,paramsSerializer:s,timeout:s,timeoutMessage:s,withCredentials:s,adapter:s,responseType:s,xsrfCookieName:s,xsrfHeaderName:s,onUploadProgress:s,onDownloadProgress:s,decompress:s,maxContentLength:s,maxBodyLength:s,beforeRedirect:s,transport:s,httpAgent:s,httpsAgent:s,cancelToken:s,socketPath:s,responseEncoding:s,validateStatus:a,headers:(t,e)=>o(Lt(t),Lt(e),!0)};return k.forEach(Object.keys(Object.assign({},t,e)),(function(r){const i=c[r]||o,s=i(t[r],e[r],r);k.isUndefined(s)&&i!==a||(n[r]=s)})),n}const xt={};["object","boolean","number","function","string","symbol"].forEach(((t,e)=>{xt[t]=function(n){return typeof n===t||"a"+(e<1?"n ":" ")+t}}));const At={};xt.transitional=function(t,e,n){function r(t,e){return"[Axios v1.6.0] Transitional option '"+t+"'"+e+(n?". "+n:"")}return(n,o,i)=>{if(!1===t)throw new I(r(o," has been removed"+(e?" in "+e:"")),I.ERR_DEPRECATED);return e&&!At[o]&&(At[o]=!0,console.warn(r(o," has been deprecated since v"+e+" and will be removed in the near future"))),!t||t(n,o,i)}};const Tt={assertOptions:function(t,e,n){if("object"!=typeof t)throw new I("options must be an object",I.ERR_BAD_OPTION_VALUE);const r=Object.keys(t);let o=r.length;for(;o-- >0;){const i=r[o],s=e[i];if(s){const e=t[i],n=void 0===e||s(e,i,t);if(!0!==n)throw new I("option "+i+" must be "+n,I.ERR_BAD_OPTION_VALUE)}else if(!0!==n)throw new I("Unknown option "+i,I.ERR_BAD_OPTION)}},validators:xt},jt=Tt.validators;class Nt{constructor(t){this.defaults=t,this.interceptors={request:new Q,response:new Q}}request(t,e){"string"==typeof t?(e=e||{}).url=t:e=t||{},e=Rt(this.defaults,e);const{transitional:n,paramsSerializer:r,headers:o}=e;void 0!==n&&Tt.assertOptions(n,{silentJSONParsing:jt.transitional(jt.boolean),forcedJSONParsing:jt.transitional(jt.boolean),clarifyTimeoutError:jt.transitional(jt.boolean)},!1),null!=r&&(k.isFunction(r)?e.paramsSerializer={serialize:r}:Tt.assertOptions(r,{encode:jt.function,serialize:jt.function},!0)),e.method=(e.method||this.defaults.method||"get").toLowerCase();let i=o&&k.merge(o.common,o[e.method]);o&&k.forEach(["delete","get","head","post","put","patch","common"],(t=>{delete o[t]})),e.headers=ut.concat(i,o);const s=[];let a=!0;this.interceptors.request.forEach((function(t){"function"==typeof t.runWhen&&!1===t.runWhen(e)||(a=a&&t.synchronous,s.unshift(t.fulfilled,t.rejected))}));const c=[];let u;this.interceptors.response.forEach((function(t){c.push(t.fulfilled,t.rejected)}));let l,f=0;if(!a){const t=[St.bind(this),void 0];for(t.unshift.apply(t,s),t.push.apply(t,c),l=t.length,u=Promise.resolve(e);f<l;)u=u.then(t[f++],t[f++]);return u}l=s.length;let d=e;for(f=0;f<l;){const t=s[f++],e=s[f++];try{d=t(d)}catch(t){e.call(this,t);break}}try{u=St.call(this,d)}catch(t){return Promise.reject(t)}for(f=0,l=c.length;f<l;)u=u.then(c[f++],c[f++]);return u}getUri(t){return X(mt((t=Rt(this.defaults,t)).baseURL,t.url),t.params,t.paramsSerializer)}}k.forEach(["delete","get","head","options"],(function(t){Nt.prototype[t]=function(e,n){return this.request(Rt(n||{},{method:t,url:e,data:(n||{}).data}))}})),k.forEach(["post","put","patch"],(function(t){function e(e){return function(n,r,o){return this.request(Rt(o||{},{method:t,headers:e?{"Content-Type":"multipart/form-data"}:{},url:n,data:r}))}}Nt.prototype[t]=e(),Nt.prototype[t+"Form"]=e(!0)}));const Pt=Nt;class Ct{constructor(t){if("function"!=typeof t)throw new TypeError("executor must be a function.");let e;this.promise=new Promise((function(t){e=t}));const n=this;this.promise.then((t=>{if(!n._listeners)return;let e=n._listeners.length;for(;e-- >0;)n._listeners[e](t);n._listeners=null})),this.promise.then=t=>{let e;const r=new Promise((t=>{n.subscribe(t),e=t})).then(t);return r.cancel=function(){n.unsubscribe(e)},r},t((function(t,r,o){n.reason||(n.reason=new ht(t,r,o),e(n.reason))}))}throwIfRequested(){if(this.reason)throw this.reason}subscribe(t){this.reason?t(this.reason):this._listeners?this._listeners.push(t):this._listeners=[t]}unsubscribe(t){if(!this._listeners)return;const e=this._listeners.indexOf(t);-1!==e&&this._listeners.splice(e,1)}static source(){let t;return{token:new Ct((function(e){t=e})),cancel:t}}}const _t=Ct,Ft={Continue:100,SwitchingProtocols:101,Processing:102,EarlyHints:103,Ok:200,Created:201,Accepted:202,NonAuthoritativeInformation:203,NoContent:204,ResetContent:205,PartialContent:206,MultiStatus:207,AlreadyReported:208,ImUsed:226,MultipleChoices:300,MovedPermanently:301,Found:302,SeeOther:303,NotModified:304,UseProxy:305,Unused:306,TemporaryRedirect:307,PermanentRedirect:308,BadRequest:400,Unauthorized:401,PaymentRequired:402,Forbidden:403,NotFound:404,MethodNotAllowed:405,NotAcceptable:406,ProxyAuthenticationRequired:407,RequestTimeout:408,Conflict:409,Gone:410,LengthRequired:411,PreconditionFailed:412,PayloadTooLarge:413,UriTooLong:414,UnsupportedMediaType:415,RangeNotSatisfiable:416,ExpectationFailed:417,ImATeapot:418,MisdirectedRequest:421,UnprocessableEntity:422,Locked:423,FailedDependency:424,TooEarly:425,UpgradeRequired:426,PreconditionRequired:428,TooManyRequests:429,RequestHeaderFieldsTooLarge:431,UnavailableForLegalReasons:451,InternalServerError:500,NotImplemented:501,BadGateway:502,ServiceUnavailable:503,GatewayTimeout:504,HttpVersionNotSupported:505,VariantAlsoNegotiates:506,InsufficientStorage:507,LoopDetected:508,NotExtended:510,NetworkAuthenticationRequired:511};Object.entries(Ft).forEach((([t,e])=>{Ft[e]=t}));const kt=Ft,Bt=function e(n){const r=new Pt(n),o=t(Pt.prototype.request,r);return k.extend(o,Pt.prototype,r,{allOwnKeys:!0}),k.extend(o,r,null,{allOwnKeys:!0}),o.create=function(t){return e(Rt(n,t))},o}(nt);Bt.Axios=Pt,Bt.CanceledError=ht,Bt.CancelToken=_t,Bt.isCancel=ft,Bt.VERSION="1.6.0",Bt.toFormData=J,Bt.AxiosError=I,Bt.Cancel=Bt.CanceledError,Bt.all=function(t){return Promise.all(t)},Bt.spread=function(t){return function(e){return t.apply(null,e)}},Bt.isAxiosError=function(t){return k.isObject(t)&&!0===t.isAxiosError},Bt.mergeConfig=Rt,Bt.AxiosHeaders=ut,Bt.formToJSON=t=>tt(k.isHTMLForm(t)?new FormData(t):t),Bt.getAdapter=Et,Bt.HttpStatusCode=kt,Bt.default=Bt;const Ut=Bt;function Dt(t){return Dt="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},Dt(t)}function It(){It=function(){return e};var t,e={},n=Object.prototype,r=n.hasOwnProperty,o=Object.defineProperty||function(t,e,n){t[e]=n.value},i="function"==typeof Symbol?Symbol:{},s=i.iterator||"@@iterator",a=i.asyncIterator||"@@asyncIterator",c=i.toStringTag||"@@toStringTag";function u(t,e,n){return Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{u({},"")}catch(t){u=function(t,e,n){return t[e]=n}}function l(t,e,n,r){var i=e&&e.prototype instanceof g?e:g,s=Object.create(i.prototype),a=new N(r||[]);return o(s,"_invoke",{value:x(t,n,a)}),s}function f(t,e,n){try{return{type:"normal",arg:t.call(e,n)}}catch(t){return{type:"throw",arg:t}}}e.wrap=l;var d="suspendedStart",h="suspendedYield",p="executing",m="completed",y={};function g(){}function b(){}function v(){}var w={};u(w,s,(function(){return this}));var E=Object.getPrototypeOf,O=E&&E(E(P([])));O&&O!==n&&r.call(O,s)&&(w=O);var S=v.prototype=g.prototype=Object.create(w);function L(t){["next","throw","return"].forEach((function(e){u(t,e,(function(t){return this._invoke(e,t)}))}))}function R(t,e){function n(o,i,s,a){var c=f(t[o],t,i);if("throw"!==c.type){var u=c.arg,l=u.value;return l&&"object"==Dt(l)&&r.call(l,"__await")?e.resolve(l.__await).then((function(t){n("next",t,s,a)}),(function(t){n("throw",t,s,a)})):e.resolve(l).then((function(t){u.value=t,s(u)}),(function(t){return n("throw",t,s,a)}))}a(c.arg)}var i;o(this,"_invoke",{value:function(t,r){function o(){return new e((function(e,o){n(t,r,e,o)}))}return i=i?i.then(o,o):o()}})}function x(e,n,r){var o=d;return function(i,s){if(o===p)throw new Error("Generator is already running");if(o===m){if("throw"===i)throw s;return{value:t,done:!0}}for(r.method=i,r.arg=s;;){var a=r.delegate;if(a){var c=A(a,r);if(c){if(c===y)continue;return c}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if(o===d)throw o=m,r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);o=p;var u=f(e,n,r);if("normal"===u.type){if(o=r.done?m:h,u.arg===y)continue;return{value:u.arg,done:r.done}}"throw"===u.type&&(o=m,r.method="throw",r.arg=u.arg)}}}function A(e,n){var r=n.method,o=e.iterator[r];if(o===t)return n.delegate=null,"throw"===r&&e.iterator.return&&(n.method="return",n.arg=t,A(e,n),"throw"===n.method)||"return"!==r&&(n.method="throw",n.arg=new TypeError("The iterator does not provide a '"+r+"' method")),y;var i=f(o,e.iterator,n.arg);if("throw"===i.type)return n.method="throw",n.arg=i.arg,n.delegate=null,y;var s=i.arg;return s?s.done?(n[e.resultName]=s.value,n.next=e.nextLoc,"return"!==n.method&&(n.method="next",n.arg=t),n.delegate=null,y):s:(n.method="throw",n.arg=new TypeError("iterator result is not an object"),n.delegate=null,y)}function T(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function j(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function N(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(T,this),this.reset(!0)}function P(e){if(e||""===e){var n=e[s];if(n)return n.call(e);if("function"==typeof e.next)return e;if(!isNaN(e.length)){var o=-1,i=function n(){for(;++o<e.length;)if(r.call(e,o))return n.value=e[o],n.done=!1,n;return n.value=t,n.done=!0,n};return i.next=i}}throw new TypeError(Dt(e)+" is not iterable")}return b.prototype=v,o(S,"constructor",{value:v,configurable:!0}),o(v,"constructor",{value:b,configurable:!0}),b.displayName=u(v,c,"GeneratorFunction"),e.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===b||"GeneratorFunction"===(e.displayName||e.name))},e.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,v):(t.__proto__=v,u(t,c,"GeneratorFunction")),t.prototype=Object.create(S),t},e.awrap=function(t){return{__await:t}},L(R.prototype),u(R.prototype,a,(function(){return this})),e.AsyncIterator=R,e.async=function(t,n,r,o,i){void 0===i&&(i=Promise);var s=new R(l(t,n,r,o),i);return e.isGeneratorFunction(n)?s:s.next().then((function(t){return t.done?t.value:s.next()}))},L(S),u(S,c,"Generator"),u(S,s,(function(){return this})),u(S,"toString",(function(){return"[object Generator]"})),e.keys=function(t){var e=Object(t),n=[];for(var r in e)n.push(r);return n.reverse(),function t(){for(;n.length;){var r=n.pop();if(r in e)return t.value=r,t.done=!1,t}return t.done=!0,t}},e.values=P,N.prototype={constructor:N,reset:function(e){if(this.prev=0,this.next=0,this.sent=this._sent=t,this.done=!1,this.delegate=null,this.method="next",this.arg=t,this.tryEntries.forEach(j),!e)for(var n in this)"t"===n.charAt(0)&&r.call(this,n)&&!isNaN(+n.slice(1))&&(this[n]=t)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(e){if(this.done)throw e;var n=this;function o(r,o){return a.type="throw",a.arg=e,n.next=r,o&&(n.method="next",n.arg=t),!!o}for(var i=this.tryEntries.length-1;i>=0;--i){var s=this.tryEntries[i],a=s.completion;if("root"===s.tryLoc)return o("end");if(s.tryLoc<=this.prev){var c=r.call(s,"catchLoc"),u=r.call(s,"finallyLoc");if(c&&u){if(this.prev<s.catchLoc)return o(s.catchLoc,!0);if(this.prev<s.finallyLoc)return o(s.finallyLoc)}else if(c){if(this.prev<s.catchLoc)return o(s.catchLoc,!0)}else{if(!u)throw new Error("try statement without catch or finally");if(this.prev<s.finallyLoc)return o(s.finallyLoc)}}}},abrupt:function(t,e){for(var n=this.tryEntries.length-1;n>=0;--n){var o=this.tryEntries[n];if(o.tryLoc<=this.prev&&r.call(o,"finallyLoc")&&this.prev<o.finallyLoc){var i=o;break}}i&&("break"===t||"continue"===t)&&i.tryLoc<=e&&e<=i.finallyLoc&&(i=null);var s=i?i.completion:{};return s.type=t,s.arg=e,i?(this.method="next",this.next=i.finallyLoc,y):this.complete(s)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),y},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var n=this.tryEntries[e];if(n.finallyLoc===t)return this.complete(n.completion,n.afterLoc),j(n),y}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var n=this.tryEntries[e];if(n.tryLoc===t){var r=n.completion;if("throw"===r.type){var o=r.arg;j(n)}return o}}throw new Error("illegal catch attempt")},delegateYield:function(e,n,r){return this.delegate={iterator:P(e),resultName:n,nextLoc:r},"next"===this.method&&(this.arg=t),y}},e}function qt(t,e,n,r,o,i,s){try{var a=t[i](s),c=a.value}catch(t){return void n(t)}a.done?e(c):Promise.resolve(c).then(r,o)}function Mt(t){return function(){var e=this,n=arguments;return new Promise((function(r,o){var i=t.apply(e,n);function s(t){qt(i,r,o,s,a,"next",t)}function a(t){qt(i,r,o,s,a,"throw",t)}s(void 0)}))}}var zt=document.getElementById("inputNewPassword"),Ht=document.getElementById("inputConfirmPassword"),Jt=document.getElementById("resetPasswordButton"),Gt=document.getElementById("alertWindow"),Wt=document.querySelector("nav .userImage");function Kt(t){return new Promise((function(e){return setTimeout(e,t)}))}function Vt(){return $t.apply(this,arguments)}function $t(){return($t=Mt(It().mark((function t(){var e,n,r,o;return It().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return e={password:zt.value,firstAccess:0},t.prev=1,Jt.innerHTML='\n          <div class="spinner-border" role="status">\n            <span class="visually-hidden">Loading...</span>\n          </div>',Jt.disabled=!0,t.next=6,Ut.put("http://localhost/lemonade/api/user/update/".concat(Wt.id),e,{headers:{ltoken:"b3050e0156cc3d05ddb7bbd9"}});case 6:if(n=t.sent,Jt.innerText="Enviar",!n.data.success){t.next=12;break}window.location.href="http://localhost/lemonade/wapp",t.next=19;break;case 12:return Jt.disabled=!1,r=Gt.querySelector(".toast-body"),Gt.classList.add("show"),r.textContent=n.data.message,t.next=18,Kt(5e3);case 18:Gt.classList.remove("show");case 19:t.next=31;break;case 21:return t.prev=21,t.t0=t.catch(1),Jt.innerText="Enviar",Jt.disabled=!1,o=Gt.querySelector(".toast-body"),Gt.classList.add("show"),o.textContent="Houve um erro ao tentar alterar a senha. Por favor, tente novamente mais tarde.",t.next=30,Kt(1e4);case 30:Gt.classList.remove("show");case 31:case"end":return t.stop()}}),t,null,[[1,21]])})))).apply(this,arguments)}Ht.addEventListener("input",(function(){var t=zt.value,e=Ht.value;if(0===e.length)return zt.classList.remove("is-valid"),zt.classList.remove("is-invalid"),Ht.classList.remove("is-valid"),void Ht.classList.remove("is-invalid");t.length>=5&&t===e?(zt.classList.contains("is-invalid")&&zt.classList.remove("is-invalid"),Ht.classList.contains("is-invalid")&&Ht.classList.remove("is-invalid"),zt.classList.contains("is-valid")||zt.classList.add("is-valid"),Ht.classList.contains("is-valid")||Ht.classList.add("is-valid")):(zt.classList.contains("is-invalid")||zt.classList.add("is-invalid"),Ht.classList.contains("is-invalid")||Ht.classList.add("is-invalid"),zt.classList.contains("is-valid")&&zt.classList.remove("is-valid"),Ht.classList.contains("is-valid")&&Ht.classList.remove("is-valid"))})),Jt.addEventListener("click",function(){var t=Mt(It().mark((function t(e){return It().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return e.preventDefault(),t.next=3,Vt();case 3:case"end":return t.stop()}}),t)})));return function(e){return t.apply(this,arguments)}}())})()})();