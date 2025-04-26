import 'use-bootstrap-tag/dist/use-bootstrap-tag.css'
import UseBootstrapTag from "use-bootstrap-tag";
import './bootstrap';
import 'laravel-datatables-vite';
import Alpine from 'alpinejs';
import sort from '@alpinejs/sort'
import component from 'alpinejs-component'

window.xComponent = {
    name: 'a-component',
}

Alpine.plugin(component)
Alpine.plugin(sort);

Alpine.start();

window.Alpine = Alpine;



const tagInput = UseBootstrapTag(document.getElementById('tagInput'))
