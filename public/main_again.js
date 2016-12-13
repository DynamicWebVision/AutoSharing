/**
 * Created by Brian on 10/27/16.
 */
Vue.component('tasks', {
   template: '#task-template',
    data: function() {
      return {
          list: []
      }
    },
    created: function() {

        this.fetchTaskList();
//        $.getJSON('api/tasks', function(data) {
//            this.list = data;
//        }.bind(this));

    },
    methods: {
        fetchTaskList: function() {

            this.$http.get('/api/tasks').then((response) => {
                console.log(response.data);
                this.list = response.data;

            }, (response) => {
                // error callback
            });

        },
        deleteTask: function(task) {
            this.list.$remove(task);
        }
    }
});

new Vue({
    el: 'body'
});