import moment from 'moment'
import Vue from 'vue'
const converter = require('number-to-words');

// Date
Vue.filter('dateFormat', (arg) =>{
  return moment(new Date(arg)).format("Do MMMM YYYY")
})

// Time
Vue.filter('timeFormat', (arg) =>{
  return moment(new Date(arg)).format("hh:mm A")
})

// Wordlimit
Vue.filter('wordlimit', (text,length,suffix) => {
  return  text.substring(0,length) + suffix;
});

// number-to-words
Vue.filter('toWords', function(value) {
  if (!value) return '';
  return converter.toWords(value);
})

// uc First
Vue.filter('capitalize', function (value) {
  if (!value) return ''
  value = value.toString()
  return value.charAt(0).toUpperCase() + value.slice(1)
})
