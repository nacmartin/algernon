Array.implement({
  shuffle: function() {
    //destination array
    for(var j, x, i = this.length; i; j = parseInt(Math.random() * i), x = this[--i], this[i] = this[j], this[j] = x);
    return this;
  }
});

var Asker = new Class({
    Implements: [Options, Events],
    options: {
        questions: [],
        urlUpgrade: "",
    },
    initialize: function(options){
        this.setOptions(options);
        if(this.options.questions.length) this.showQuestion();
        $('feed').addEvent('click',this.feedQuestions.bind(this));
    },
    showQuestion: function(){
    },
    feedQuestions: function(){
        function isLevel0(question) {
            return (question.level === 0);
        }

        var inlevel0 = this.options.questions.filter(isLevel0);
        var ids = [];
        if (inlevel0.length <= 10){
            inlevel0.each(function(question){
                this.upgrade(question.id);
                ids.push(question.id);
            }.bind(this));
        }else{
            inlevel0.shuffle();
            for (var i = 0; i < 10; i++) {
                this.upgrade(inlevel0[i].id);
                ids.push(inlevel0[i].id);
            };
        }
        alert(JSON.encode(ids));
        new Request({method: 'get', url:'/app_dev.php/upgrade', data: {card_ids: JSON.encode(ids)}}).send();
    },
    upgrade: function(id){
        var toupgrade = this.options.questions.filter(function(question){return (question.id === id);});
        toupgrade[0].level++;
    }
});
