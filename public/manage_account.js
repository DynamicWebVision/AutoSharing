/**
 * Created by Brian on 10/26/16.
 */

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

Vue.component('acount-status', {
    template: '#social-media-app',
    data: function() {
        return {
            accounts: {
                twitter: false,
                dog: "Jessie",
                twitterName: ''
            },
            test: false,
            dog: 'Jessie'
        }
    },
    created: function() {
        this.getAccounts();
    },
    methods: {
        getAccounts: function() {
            this.$http.get('/api/social_accounts').then((response) => {
            var accounts = response.data;
            console.log(accounts);

            this.accounts.twitter = accounts.twitter;
            this.accounts.twitterName = accounts.twitterInfo.name;
           // console.log(this.accouts);
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
    el: '#main-account',
    data: function() {
        return {
            accounts: {
                twitter: true,
                dog: "Bailey"
            },
            test: false,
            dog: 'Bailey'
        }
    }
});