require('./bootstrap');

require('alpinejs');

import Alpine from 'alpinejs'

window.Alpine = Alpine

import todo from './todo.js'


Alpine.data('todo', todo)

Alpine.start()
