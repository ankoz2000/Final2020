(this["webpackJsonpreact-intro"]=this["webpackJsonpreact-intro"]||[]).push([[0],{15:function(e,t,s){},16:function(e,t,s){"use strict";s.r(t);var a=s(0),l=s(1),i=s.n(l),c=s(9),n=s.n(c),r=(s(15),s(3)),d=s(4),j=s(6),o=s(5),h=function(e){Object(j.a)(s,e);var t=Object(o.a)(s);function s(e){var a;return Object(r.a)(this,s),(a=t.call(this,e)).state={error:null,isLoaded:!1,items:[]},a}return Object(d.a)(s,[{key:"componentDidMount",value:function(){var e=this;fetch("/scr/curl.php").then((function(e){return e.json()})).then((function(t){e.setState({isLoaded:!0,items:t.items})}),(function(t){e.setState({isLoaded:!0,error:t})}))}},{key:"render",value:function(){var e=this.state,t=(e.error,e.isLoaded,e.items);return Object(a.jsxs)("div",{class:"col-md-12",children:[Object(a.jsxs)("ul",{class:"list-group",children:[Object(a.jsx)("li",{class:"list-group-item",children:"Java \u0440\u0430\u0437\u0440\u0430\u0431\u043e\u0442\u0447\u0438\u043a"}),Object(a.jsx)("li",{class:"list-group-item",children:"\u0422\u0435\u0441\u0442\u0438\u0440\u043e\u0432\u0449\u0438\u043a"}),Object(a.jsx)("li",{class:"list-group-item",children:"\u0418\u043d\u0436\u0435\u043d\u0435\u0440"}),Object(a.jsx)("li",{class:"list-group-item",children:"\u0414\u0438\u0437\u0430\u0439\u043d\u0435\u0440"}),Object(a.jsx)("li",{class:"list-group-item",children:"\u0411\u044d\u043a\u0435\u043d\u0434"})]}),Object(a.jsx)("ul",{children:t.map((function(e){return Object(a.jsxs)("li",{children:[e.name," ",e.desc]},e.id)}))})]})}}]),s}(i.a.Component),b=s(7),x=s(2),u={main:{alignContent:"center",backgroundColor:"rgb(193, 209, 223)"},place:{width:"fit-content"}},O=function(e){Object(j.a)(s,e);var t=Object(o.a)(s);function s(){var e;Object(r.a)(this,s);for(var a=arguments.length,l=new Array(a),i=0;i<a;i++)l[i]=arguments[i];return(e=t.call.apply(t,[this].concat(l))).handleSubmit=e.handleSubmit.bind(Object(x.a)(e)),e.handleDelete=e.handleDelete.bind(Object(x.a)(e)),e.state={fieldValue:"",fieldsCount:0,fields:[],skills:[]},e}return Object(d.a)(s,[{key:"handleSubmit",value:function(e){var t=e.target[0].value;console.log("Skill \u0434\u043e\u0431\u0430\u0432\u043b\u0435\u043d: ",t),this.setState({skills:[].concat(Object(b.a)(this.state.skills),[t])}),this.setState({fields:[].concat(Object(b.a)(this.state.fields),[this.addField(t)])}),e.target[0].value="",e.preventDefault()}},{key:"addField",value:function(e){return this.setState({fieldsCount:this.state.fieldsCount+1}),Object(a.jsxs)("div",{id:this.state.fieldsCount,className:u.place,children:[Object(a.jsx)("span",{children:e}),Object(a.jsx)("button",{className:"delete",type:"submit",onClick:this.handleDelete,children:Object(a.jsx)("img",{src:"../images/image.png",width:"3px",height:"3px",alt:""})})]})}},{key:"handleDelete",value:function(e){var t=this,s=e.target.parentNode.id;if(console.log("Clickable-Elem ID: ",s),console.log("skills-state before: ",this.state.skills),this.state.skills.length>0){var a=this.state.skills.filter((function(e){return console.log(parseInt(t.state.skills.indexOf(e))!==parseInt(s)),parseInt(t.state.skills.indexOf(e))!==parseInt(s)}));console.log("skills-state after: ",a),this.setState({skills:this.state.skills})}else this.setState({skills:[]});this.setState({fields:[]}),this.setState({fieldsCount:0}),this.state.skills.forEach((function(e){console.log("ELEM: ",e),t.setState({fields:[].concat(Object(b.a)(t.state.fields),[t.addField(e)])})})),e.preventDefault()}},{key:"render",value:function(){var e=this,t=[];return this.state.skills.forEach((function(s){t.push(e.state.fields)})),Object(a.jsxs)("form",{onSubmit:this.handleSubmit,children:[Object(a.jsxs)("div",{class:"form-group",children:[Object(a.jsx)("label",{for:"exampleInputEmail1",children:"\u0412\u0432\u043e\u0434 \u043a\u043b\u044e\u0447\u0435\u0432\u044b\u0445 \u0441\u043b\u043e\u0432"}),Object(a.jsx)("input",{type:"found",class:"form-control",id:"exampleInputFound",padding:"20px","aria-describedby":"foundHelp"}),Object(a.jsx)("small",{id:"foundHelp",class:"form-text text-muted",children:"\u0412\u0432\u0435\u0434\u0438\u0442\u0435 \u0437\u043d\u0430\u0447\u0435\u043d\u0438\u0435."})]}),Object(a.jsxs)("div",{class:"form-group form-check",children:[Object(a.jsx)("input",{type:"checkbox",class:"form-check-input",id:"exampleCheck1"}),Object(a.jsx)("label",{class:"form-check-label",for:"exampleCheck1",children:"\u0447\u0435\u043a\u0431\u043e\u043a\u0441"})]}),Object(a.jsx)("div",{id:"skills",style:u.place,children:t}),Object(a.jsx)("button",{type:"submit",class:"btn btn-primary",children:"\u041d\u0430\u0439\u0442\u0438"})]})}}]),s}(i.a.Component);n.a.render(Object(a.jsxs)(i.a.StrictMode,{children:[Object(a.jsx)("html",{lang:"ru"}),Object(a.jsxs)("head",{children:[Object(a.jsx)("meta",{charset:"UTF-8"}),Object(a.jsx)("meta",{name:"viewport",content:"width=device-width, initial-scale=1.0"}),Object(a.jsx)("title",{children:"HR-service"}),Object(a.jsx)("link",{rel:"stylesheet",type:"text/css",href:"./styles/index.css"}),Object(a.jsx)("link",{rel:"stylesheet",href:"https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css",integrity:"sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2",crossorigin:"anonymous"})]}),Object(a.jsxs)("body",{children:[Object(a.jsx)("nav",{class:"navbar navbar-dark bg-dark",children:Object(a.jsxs)("nav",{class:"navbar navbar-expand-lg navbar-light bg-dark",children:[Object(a.jsx)("a",{class:"navbar-brand",href:"#",children:"\u041f\u0418\u041a\u0421\u0415\u041b\u0418"}),Object(a.jsx)("button",{class:"navbar-toggler",type:"button","data-toggle":"collapse","data-target":"#navbarText","aria-controls":"navbarText","aria-expanded":"false","aria-label":"Toggle navigation",children:Object(a.jsx)("span",{class:"navbar-toggler-icon"})}),Object(a.jsxs)("div",{class:"collapse navbar-collapse",id:"navbarText",children:[Object(a.jsxs)("ul",{class:"navbar-nav mr-auto",children:[Object(a.jsx)("li",{class:"nav-item active",children:Object(a.jsxs)("a",{class:"nav-link",href:"#",children:["\u0413\u043b\u0430\u0432\u043d\u0430\u044f ",Object(a.jsx)("span",{class:"sr-only"})]})}),Object(a.jsx)("li",{class:"nav-item",children:Object(a.jsx)("a",{class:"nav-link",href:"#",children:"\u041e \u043d\u0430\u0441"})}),Object(a.jsx)("li",{class:"nav-item",children:Object(a.jsx)("a",{class:"nav-link",href:"#"})})]}),Object(a.jsx)("span",{class:"navbar-text"})]})]})}),Object(a.jsx)("div",{id:"wrap",children:Object(a.jsx)("div",{id:"page",children:Object(a.jsx)("div",{class:"container",children:Object(a.jsxs)("div",{class:"col-md-12 text-center",children:[Object(a.jsx)("h1",{children:"HR-service"}),Object(a.jsxs)("div",{id:"count",children:[Object(a.jsx)(O,{}),Object(a.jsx)("hr",{}),Object(a.jsx)("h2",{children:"\u0421\u043f\u0438\u0441\u043e\u043a \u0440\u0435\u0437\u044e\u043c\u0435"}),Object(a.jsxs)("div",{class:"col-md-12",children:[Object(a.jsx)(h,{}),Object(a.jsx)("nav",{"aria-label":"Page navigation example",children:Object(a.jsxs)("ul",{class:"pagination justify-content-center",children:[Object(a.jsx)("li",{class:"page-item disabled",children:Object(a.jsx)("a",{class:"page-link",href:"#",tabIndex:"-1","aria-disabled":"true",children:"\u041d\u0430\u0437\u0430\u0434"})}),Object(a.jsx)("li",{class:"page-item",children:Object(a.jsx)("a",{class:"page-link",href:"#",children:"1"})}),Object(a.jsx)("li",{class:"page-item",children:Object(a.jsx)("a",{class:"page-link",href:"#",children:"2"})}),Object(a.jsx)("li",{class:"page-item",children:Object(a.jsx)("a",{class:"page-link",href:"#",children:"3"})}),Object(a.jsx)("li",{class:"page-item",children:Object(a.jsx)("a",{class:"page-link",href:"#",children:"\u0414\u0430\u043b\u0435\u0435"})})]})})]})]})]})})})})]})]}),document.getElementById("root"))}},[[16,1,2]]]);
//# sourceMappingURL=main.4b244301.chunk.js.map