$.fn.xcate = function(category,pid,cid){

    this.p = $(this).find('select[lay-filter=category]');

    this.c = $(this).find('select[lay-filter=child]');

    this.childList = [];


    this.showP  = function(category) {

        this.p.html('');

        is_pid = false;

        for (var i in category) {

            if(pid==category[i].id){
                is_pid = true;
                this.childList = category[i].childList;
                this.p.append("<option selected value='"+category[i].id+"'>"+category[i].name+"</option>")
            }else{
                this.p.append("<option value='"+category[i].id+"'>"+category[i].name+"</option>")
            }
        }
        if(!is_pid){
            this.childList = category[0].childList;
        }

    }

    this.showC = function (childList) {

        this.c.html('');

        is_cid = false;

        for (var i in childList) {
            if(cid==childList[i].id){
                is_cid = true;
                console.log('cid---',childList);
                this.c.append("<option selected value='"+childList[i].id+"'>"+childList[i].name+"</option>")
            }else{
                this.c.append("<option value='"+childList[i].id+"'>"+childList[i].name+"</option>")
            }
        }
    }


    this.showP(category);
    this.showC(this.childList);

    form.render('select');

    form.on('select(category)', function(data){
        var pid = data.value;
        $(data.elem).parents(".x-cate").xcate(category,pid);
    });

    form.on('select(child)', function(data){
        var cid = data.value;
        var pid = $(data.elem).parents(".x-city").find('select[lay-filter=province]').val();
        console.log(pid);
        $(data.elem).parents(".x-city").xcate(category,pid,cid);
    });

    return this;
}
