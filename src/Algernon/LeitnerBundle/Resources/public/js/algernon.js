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
    current: undefined,
    initialize: function(options){
        this.setOptions(options);
        if(this.options.questions.length) this.showQuestion();
        $('feed').addEvent('click',this.feedQuestions.bind(this));
        $('showanswer').addEvent('click',this.showAnswer.bind(this));
        $('right').addEvent('click',this.rightAnswer.bind(this));
        $('wrong').addEvent('click',this.wrongAnswer.bind(this));
        this.showRemaining();
        $('answer').hide();
        $('right').hide();
        $('wrong').hide();
    },
    showQuestion: function(){
        var askable = this.options.questions.filter(function(question){return (question.level !== 0);});
        if(askable.length !== 0){
            this.current = askable.getRandom();
            $('question').set('text', this.current.question);
            $('showanswer').show();
            $('answer').hide();
            $('right').hide();
            $('wrong').hide();
        }else{
            $('showanswer').hide();
        }
    },
    showRemaining: function(){
        var askable = this.options.questions.filter(function(question){return (question.level !== 0);});
        var remaining = askable.length;
        $('remaining').set('text', remaining);
        $('pool').set('text', this.options.questions.length - remaining);
        if(remaining === 0){
            $('endSession').show();
        }else{
            $('endSession').hide();
        }
    },
    showAnswer: function(){
        $('answer').set('text', this.current.answer);
        $('answer').show();
        $('right').show();
        $('wrong').show();
    },
    rightAnswer: function(){
        this.options.questions.erase(this.current);
        new Request({method: 'get', url:'/app_dev.php/right', data: {id: this.current.id}}).send();
        this.showQuestion();
        this.showRemaining();

    },
    wrongAnswer: function(){
        this.options.questions.erase(this.current);
        new Request({method: 'get', url:'/app_dev.php/wrong', data: {id: this.current.id}}).send();
        this.showQuestion();
        this.showRemaining();
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
        new Request({method: 'get', url:'/app_dev.php/upgrade', data: {card_ids: JSON.encode(ids)}}).send();
        if(!this.current){
            this.showQuestion();
        }
    },
    upgrade: function(id){
        var toupgrade = this.options.questions.filter(function(question){return (question.id === id);});
        toupgrade[0].level++;
        this.showRemaining();
    }
});
