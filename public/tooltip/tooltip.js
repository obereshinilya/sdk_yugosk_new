// class TooltipTypes{
//     static classicPrompt='classicPrompt'
// }

var TooltipTypes={
    'classicPrompt':'classicPrompt'
}

class Tooltip{
    //Для старых не работает
    // #content;
    // #id;
    // #type;
    // #form;

    constructor(content, id, bind_link_data, type=TooltipTypes['classicPrompt']) {
        this.content=content;
        this.id=id;
        this.type=type.toString();
        this.form=null;
        this.html_forming();
        this.bind_event(bind_link_data)
    }

    change_content(content){
        this.content=content;
    }

    html_forming(){
        this.form=document.createElement('div');
        this.form.id=this.id;
        this.form.className=this.type;
        this.form.appendChild(this.content);
        document.body.appendChild(this.form);
    }

    bind_event(bind_link_data){
        var id=this.id
        $(`#${bind_link_data}`).mousemove(function (eventObject){
            $(`#${id}`)
                .css({
                    "top":eventObject.pageY+5,
                    "left":eventObject.pageX+5
                })
                .show();
        }).mouseout(function () {
            $(`#${id}`).hide()
                .css({
                    "top":0,
                    "left":0
                })
        });
    }
}
