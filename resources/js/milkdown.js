import {Editor, rootCtx} from '@milkdown/core';
import { commonmark } from '@milkdown/preset-commonmark';
import { history } from '@milkdown/plugin-history';

Editor
    .make()
    .config((ctx) => {
        ctx.set(rootCtx, document.querySelector('#editor'));
    })
    .use(commonmark)
    .use(history)
    .create();
