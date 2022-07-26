require('./bootstrap');
require('alpinejs')

import Alpine from 'alpinejs'
import todo from './todo.js'

Alpine.data('todo', todo)

Alpine.start()
