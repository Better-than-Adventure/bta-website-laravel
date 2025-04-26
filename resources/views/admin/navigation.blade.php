<x-layout.admin>
    <h2>Manage Top Level Navigation</h2>
    <hr/>
    <div x-data="
    {
        iterator: 0,
        nav: [
        ],
        editMode: false,
        add(isParent) {
            let key = this.iterator++
            this.nav.push({
                key,
                title: isParent ? 'New Group' : 'New Route',
                slug: '',
                child: false,
                parentKey: null,
                children: isParent ? [] : null,
                editMode: true
            })
        },
        addChild(parentKey) {
            let key = this.iterator++
            let index = this.nav.findIndex((r) => r.key == parentKey)

            this.nav[index].children.push({
                key,
                title: 'New Child',
                slug: '',
                parentKey: parentKey,
                children: null,
                editMode: true
            })
        },
        remove(key) {
            let index = this.nav.findIndex((r) => r.key == key)
            this.nav.splice(index, 1)
        },
        removeChild(parentKey, key) {
            let parentIndex = this.nav.findIndex((r) => r.key == parentKey)
            let index = this.nav[parentIndex].children.findIndex((r) => r.key == key)
            this.nav[parentIndex].children.splice(index, 1)
        }
    }">

    <button class="btn btn-outline-primary me-1" x-on:click="add(false)">+ New Route</button>
    <button class="btn btn-outline-primary me-1" x-on:click="add(true)">+ New Group</button>
    <button class="btn btn-primary right-0">Save Changes</button>
    <button class="btn btn-secondary me-1" x-on:click="editMode = !editMode" x-text="editMode ? 'Preview Mode' : 'Edit Mode'"></button>


        <div class="navigation-manager mx-auto" style="max-width: 900px;" x-sort:config="{ handle: '[x-sort\\:handle]' }" x-sort>
            <template x-for="item in nav" :key="item.key">
                <div x-sort:item class="nav-card">
                    <div class="d-flex">
                        <div x-sort:handle><i class="text-muted fa-solid fa-arrows-up-down pe-3"></i></div>
                        <div class="flex-fill">
                            <x-admin-navigation-item data="{ item: item }"></x-admin-navigation-item>
                            <template x-if="item.children">
                                <div class="navigation-manager py-1"  x-sort:config="{ handle: '[x-sort\\:handle]' }" x-sort>
                                    <template x-for="child in item.children" :key="child.key">
                                        <div x-sort:item class="nav-card">
                                            <div class="d-flex">
                                                <div x-sort:handle><i class="text-muted fa-solid fa-arrows-up-down pe-3"></i></div>
                                                <div class="flex-fill">
                                                    <x-admin-navigation-item data="{ item: child }"></x-admin-navigation-item>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                    <template x-if="item.children.length == 0">
                                        <div class="text-muted"> No Children</div>
                                    </template>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
        </div>

    </div>
</x-layout.admin>

<script>
</script>
