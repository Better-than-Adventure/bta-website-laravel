@props([
    'data',
])

<div x-data="{{$data}}" class="d-flex justify-content-between">
    <div>
        <template x-if="editMode">
            <div class="d-flex form-group">
                <input type="text" class="form-control me-1" x-model="item.title">
                <input type="text" class="form-control" x-model="item.slug">
            </div>
        </template>
        <template x-if="!editMode">
            <div class="d-flex">
                <div class="me-3 fw-bold" x-text="item.title"></div>
                <div class="text-muted" x-text="item.slug"></div>
            </div>
        </template>
    </div>
    <div class="col-md-4 d-flex justify-content-end">
        <template x-if="item.children">
            <a class="px-1" x-on:click="addChild(item.key)" href="#">Add Child</a>
        </template>
        <a class="px-1" x-on:click="item.parentKey ? removeChild(item.parentKey, item.key) : remove(item.key)" href="#">Delete</a>
    </div>
</div>
