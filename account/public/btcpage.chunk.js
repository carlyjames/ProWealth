(this["webpackJsonppayment-app"]=this["webpackJsonppayment-app"]||[]).push([[4],{283:function(e,n,t){"use strict";n.a=function(e){var n;return(null===(n=e.response)||void 0===n?void 0:n.data.user_msg)||"Something went wrong!"}},286:function(e,n,t){"use strict";t.d(n,"b",(function(){return r})),t.d(n,"a",(function(){return s}));var c=t(43),a=t(126),o={BTC1:c.b.BTC_PAGE,BTC2:c.b.BTC_SEND_PAGE,BTC3:c.b.BTC_BUY_PAGE,BTC4:c.b.BTC_BUY_PAGE,BTC5:c.b.BTC_SEND_PAGE},r=function(e){return Object(a.a)(o[e])},s=function(e){return e.toFixed(8)}},288:function(e,n,t){"use strict";var c=t(0),a=t(25),o=t(9),r=t(1),s={"Cancelled by user":function(e,n){return"Your ".concat(e," ").concat(n," transaction has been Cancelled.")},Approved:function(e,n){return"Your transaction with  ".concat(e," ").concat(n,"  amount has Approved by an Admin.")},Denied:function(e,n){return"Your transaction with  ".concat(e," ").concat(n,"  amount has denied by an Admin.")},Finished:function(e,n){return"Your transaction with  ".concat(e," ").concat(n,"  has finished!")},Timeout:function(){return"Your transaction got timed out!"}};n.a=function(e){var n=e.message,t=e.amount,i=e.currency,l=Object(c.useMemo)((function(){return s[n](t,i)}),[t,i,n]);return Object(r.jsxs)("div",{children:[Object(r.jsx)("strong",{children:l}),Object(r.jsx)(a.k,{children:Object(r.jsx)(a.a,{className:"is-narrow",children:Object(r.jsx)(a.h,{className:"simple-button",onClick:function(){return window.location.href=o.r},children:"Return to Account Overview"})})})]})}},290:function(e,n,t){"use strict";var c=t(6),a=t(74),o=t(0),r=t(125),s=t(46),i=t(283);n.a=function(){var e=Object(o.useState)(),n=Object(a.a)(e,2),t=n[0],l=n[1],u=Object(o.useState)(),d=Object(a.a)(u,2),b=d[0],j=d[1],f=Object(r.f)().search,m=Object(o.useMemo)((function(){return new URLSearchParams(f).get("mcTxId")}),[f]),h=Object(o.useMemo)((function(){if(b&&!t)return b}),[b,t]),p=Object(o.useMemo)((function(){return!t}),[t]),O=Object(o.useMemo)((function(){return t?"".concat(t.firstName," ").concat(t.lastName):""}),[t]),x=Object(o.useCallback)((function(e){m&&Object(s.n)({mcTxId:m,fullInfo:e}).then((function(e){return l((function(n){return Object(c.a)(Object(c.a)({},n),e.data.payload)}))})).catch((function(e){return j(Object(i.a)(e))}))}),[m]),v=Object(o.useCallback)((function(){m&&Object(s.d)(m).then((function(e){return l((function(n){return Object(c.a)(Object(c.a)({},n),e.data.payload)}))})).catch((function(e){return j(Object(i.a)(e))}))}),[m]);return Object(o.useEffect)((function(){m&&Object(s.f)(m).then((function(e){return l(e.data.payload)})).catch((function(e){var n;"isAxiosError"in e&&(4226===(null===(n=e.response)||void 0===n?void 0:n.data.status_code)?x(!0):j(Object(i.a)(e)))}))}),[m,x]),Object(o.useEffect)((function(){if(t&&!t.transactionComplete){var e=setInterval((function(){return x(!1)}),5e3);return function(){return clearInterval(e)}}}),[t,x]),{transaction:Object(c.a)(Object(c.a)({},t),{},{fullName:O}),cancelTransaction:v,error:h,isLoading:p,mcTxId:m}}},296:function(e,n,t){},301:function(e,n,t){},332:function(e,n,t){"use strict";t.r(n);var c,a,o=t(13),r=t(0),s=t.n(r),i=t(11),l=t(130),u=t.n(l),d=t(9),b=t(34),j=t(35),f=t(37),m=t(36),h=t(293),p=(t(296),t(1)),O=i.c.div(c||(c=Object(o.a)(["\n  background-color: "," !important;\n"])),d.f.baseColor),x=i.c.a(a||(a=Object(o.a)(["\n  font-weight: 700;\n  position: relative;\n  color: "," !important;\n\n  :hover {\n    color: ",' !important;\n  }\n\n  :hover:before {\n    width: 100%;\n  }\n\n  :before {\n    content: "";\n    width: 0;\n    height: 2px;\n    background-color: '," !important;\n    border-radius: 2px;\n    position: absolute;\n    left: 50%;\n    bottom: 0px;\n    transform: translateX(-50%);\n    transition: all 0.3s;\n  }\n"])),d.f.baseColor,d.f.baseColor,d.f.baseColor),v=function(e){var n=e;return"number"===typeof n&&(n=n.toString()),n.padStart(2,"0")},C=function(e){var n=e.minutes,t=e.seconds;return e.completed?Object(p.jsx)("div",{children:"Terminated"}):Object(p.jsxs)("span",{children:["You have"," ",Object(p.jsxs)("strong",{children:[v(n),":",v(t)]})," ","minutes to initiate the transaction"]})},g=function(e){Object(f.a)(t,e);var n=Object(m.a)(t);function t(e){var c;return Object(b.a)(this,t),(c=n.call(this,e)).onTick=function(){var e,n,t=c.state.progress+1e3;t%1e4===0&&(null===(e=(n=c.props).onCheckTransaction)||void 0===e||e.call(n));c.setState({progress:t})},c.onComplete=function(){var e,n;null===(e=(n=c.props).onComplete)||void 0===e||e.call(n)},c.handleFinished=function(){c.setState({expired:!0})},c.state={dateValue:Date.now()+9e5,progress:0,expired:!1},c}return Object(j.a)(t,[{key:"render",value:function(){var e=this;return this.state.expired?Object(p.jsx)("div",{children:"Transaction Expired"}):Object(p.jsxs)("div",{className:"c-100",children:[Object(p.jsx)("span",{children:Object(p.jsx)(h.a,{date:this.state.dateValue,renderer:C,onTick:this.onTick,onComplete:this.onComplete})}),Object(p.jsx)("div",{className:"timer-c",children:Object(p.jsx)("div",{className:"timer-c",children:Object(p.jsx)(O,{className:"timer",style:{width:"".concat(this.state.progress/1e3,"px")}})})}),Object(p.jsx)(x,{onClick:function(n){var t,c;n.preventDefault(),null===(t=(c=e.props).onCancelTransaction)||void 0===t||t.call(c)},children:"Cancel transaction"})]})}}]),t}(s.a.Component);g.defaultProps={onComplete:function(){}};var y,N,w,T=g,k=t(297),B=(t(301),t(25)),S=t(290),A=t(288),E=t(286),_=i.c.a(y||(y=Object(o.a)(["\n  color: "," !important;\n\n  :hover {\n    color: "," !important;\n  }\n\n  :before {\n    background-color: ",";\n  }\n"])),d.h?"white":"rgba(40, 40, 40, 0.5)",d.f.baseColor,d.f.baseColor),P=i.c.button(N||(N=Object(o.a)(["\n  background-color: ",";\n  ",";\n\n  :hover {\n    background-color: ",";\n    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.25);\n    box-shadow: inset 0 0 0 1px ",",\n    -20px 0 30px 0 ",";\n  }\n"])),d.f.baseColor,d.g&&d.g,d.f.baseColor,d.f.baseColor,d.f.opacityColor),I=i.c.label(w||(w=Object(o.a)([""])));n.default=Object(B.t)((function(){var e=Object(S.a)(),n=e.transaction,t=e.error,c=e.isLoading,a=e.mcTxId,o=e.cancelTransaction;if(Object(r.useEffect)((function(){c||d.o&&n&&u.a.identify(n.clientId,{name:n.fullName,email:n.email,gateway:"Payment ".concat(d.e)})}),[n,c]),!a)return Object(p.jsx)("div",{children:"User not found."});if(t)return Object(p.jsx)("div",{children:t});if(c)return Object(p.jsx)("div",{children:"Loading..."});if("BTC1"!==n.fundingSourceName)return Object(E.b)(n.fundingSourceName),Object(p.jsx)("div",{children:"Redirecting..."});if(n.transactionComplete&&"Pending"!==n.message)return Object(p.jsx)(A.a,{message:n.message,amount:n.amount,currency:n.currency});var i=n.address,l=n.barcodeURL,b=n.btcAmount,j=n.amount,f=n.currency;return Object(p.jsxs)(s.a.Fragment,{children:[Object(p.jsx)(_,{href:d.q,className:"go-back g-link gray",children:d.s}),Object(p.jsx)("input",{id:"ShowQR",type:"checkbox",className:"hi"}),Object(p.jsxs)("div",{className:"qrcode-c",children:[Object(p.jsx)("img",{className:"barcode-image",src:l,alt:""}),Object(p.jsx)(I,{for:"ShowQR",className:"hide-qrcode",children:Object(p.jsx)("span",{})})]}),Object(p.jsx)("img",{src:"/public/static/assets/images/bitcoin.png",alt:""}),Object(p.jsx)("div",{className:"hs-20"}),Object(p.jsxs)("h3",{className:"summary-c",children:["Please pay the amount"," ",Object(p.jsxs)("span",{className:"ammount",children:[Object(E.a)(b)," (",Object(p.jsxs)("span",{className:"dollars",children:[j," ",f]}),")",Object(p.jsx)(k.CopyToClipboard,{text:Object(E.a)(b),children:Object(p.jsxs)("button",{className:"btn-copy",children:[Object(p.jsx)("span",{className:"icon copy-thick"}),Object(p.jsx)("span",{className:"info",children:"Amount Copied"})]})})]}),"of bitcoin below to fund your account"]}),Object(p.jsx)("div",{className:"hs-20"}),Object(p.jsx)(T,{onCancelTransaction:o,onComplete:function(){return window.location.href=d.r}}),Object(p.jsxs)("div",{className:"c-100 wallet-c",children:[Object(p.jsxs)("div",{className:"copy-link-c",children:[i,Object(p.jsx)(k.CopyToClipboard,{text:i,children:Object(p.jsxs)(P,{children:["Copy",Object(p.jsx)("span",{className:"icon copy-link"}),Object(p.jsx)("div",{children:"Copied"})]})})]}),Object(p.jsx)(I,{className:"btn-qrcode",for:"ShowQR",children:Object(p.jsx)("span",{className:"icon qrcode"})})]}),Object(p.jsx)("div",{className:"hs-20"}),Object(p.jsx)("small",{className:"c-100",children:"The Blockchain charges an extra 0.0005 BTC network fee which is already added to the BTC amount to pay"}),Object(p.jsxs)("small",{className:"c-100",children:[d.e," will constantly monitor for your deposit, you will be redirected once it's located however ",d.e," requires 6 network confirmations before approving it"]})]})}))}}]);
//# sourceMappingURL=BtcPage.96c94860.chunk.js.map