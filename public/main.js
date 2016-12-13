/**
 * Created by Brian on 10/26/16.
 */

var data = {
    tasks: [
        {
            body: 'Go to store',
            completed: false
        },
        {
            body: 'Go to have sex',
            completed: true
        },
        {
            body: 'Go to rain',
            completed: true
        }

    ],
    dog: "Bailey"
};

//Vue.component('ap-tasks', {
//    props: ['list'],
//    template: '#task-template',
//    computed: {
//        remaining: function() {
//            var vm = this;
//
//            return this.list.filter(function(task) {
//                return !vm.isCompleted(task);
//            }).length;
//        }
//    },
//    methods: {
//        isCompleted: function(task) {
//            return task.completed;
//        },
//        removeTask: function(task) {
//            this.list.$remove(task);
//        }
//    }
//});

new Vue({
    el: '#social-media-app',
    data: data
});