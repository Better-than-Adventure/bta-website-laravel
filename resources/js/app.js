import 'use-bootstrap-tag/dist/use-bootstrap-tag.css'
import UseBootstrapTag from "use-bootstrap-tag";
import './bootstrap';
import 'laravel-datatables-vite';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const tagInput = UseBootstrapTag(document.getElementById('tagInput'))
