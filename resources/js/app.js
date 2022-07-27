require('./bootstrap');

require('alpinejs');

import Alpine from 'alpinejs'

window.Alpine = Alpine

import todo from './todo.js'

Alpine.store('globalTask', {
    appUrl : process.env.MIX_APP_URL,
});

Alpine.data('todo', todo)

Alpine.start()
