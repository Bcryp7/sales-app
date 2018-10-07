<template>

    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/">
                    Desktop
                </a>
            </li>
        </ol>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i>
                    Categories
                    <button @click="showModal('create')"
                            class="btn btn-secondary">
                        <i class="icon-plus"></i>
                        &nbsp; New
                    </button>
                </div>
                <div class="card-body">

                    <!-- Search -->
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">

                                <select v-model="criteria"
                                        class="form-control col-md-3">
                                    <option value="name">Name</option>
                                    <option value="description">Description</option>
                                    <option value="status">Status</option>
                                </select>

                                <input v-model="search"
                                       @keyup.enter="categoryList(1, search, criteria)"
                                       type="text"
                                       class="form-control"
                                       placeholder="Search...">

                                <button type="submit"
                                        @click="categoryList(1, search, criteria)"
                                        class="btn btn-primary">
                                    <i class="fa fa-search"></i>
                                    Search
                                </button>

                            </div>
                        </div>
                    </div>


                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                        <tr>
                            <th>Options</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr v-for="category in categories"
                            :key="category.id">
                            <td>
                                <button @click="showModal('update', category)"
                                        class="btn btn-warning btn-sm">
                                    <i class="icon-pencil"></i>
                                </button>

                                <button @click="toggleStatus(category)"
                                        :class="[
                                            'btn',
                                            'btn-sm',
                                            category.status ?
                                                'btn-danger' :
                                                'btn-success'
                                        ]">
                                    <i :class="[
                                            category.status ?
                                                'icon-trash' :
                                                'icon-check'
                                        ]"></i>
                                </button>

                            </td>
                            <td v-text="category.name"></td>
                            <td v-text="category.description"></td>
                            <td>
                                <div>

                                    <span v-if="category.status == 1"
                                          class="badge badge-success">
                                        Activated
                                    </span>
                                    <span class="badge badge-danger"
                                          v-else>
                                        Deactivated
                                    </span>

                                </div>
                            </td>
                        </tr>

                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <nav>
                        <ul class="pagination">

                            <li class="page-item"
                                v-if="pagination.current_page > 1">

                                <a class="page-link"
                                   href="#"
                                   @click.prevent="paginate(

                                       pagination.current_page - 1,
                                       search,
                                       criteria

                                   )">
                                    Before
                                </a>

                            </li>

                            <li v-for="page in pageNumber"
                                :key="page"
                                :class="[
                                    'page-item',
                                    page == isActivated ?
                                        'active' : ''
                                ]">

                                <a class="page-link"
                                   href="#"
                                   @click.prevent="paginate(

                                       page,
                                       search,
                                       criteria

                                   )"
                                   v-text="page"
                                ></a>

                            </li>

                            <li class="page-item"
                                v-if="pagination.current_page < pagination.last_page">

                                <a class="page-link"
                                   href="#"
                                   @click.prevent="paginate(

                                       pagination.current_page + 1,
                                       search,
                                       criteria

                                   )">
                                    Next
                                </a>

                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div :class="['modal', 'fade', { 'show': modal }]"
             tabindex="-1"
             role="dialog"
             aria-labelledby="myModalLabel"
             style="display: none;"
             aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title"
                            v-text="modalTitle"
                        ></h4>

                        <button @click="closeModal()"
                                class="close"
                                aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label">
                                    Name
                                </label>
                                <div class="col-md-9">
                                    <input type="text"
                                           v-model="name"
                                           class="form-control"
                                           placeholder="Name of Category...">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label">
                                    Description
                                </label>
                                <div class="col-md-9">
                                    <input type="text"
                                           v-model="description"
                                           class="form-control"
                                           placeholder="Enter Description...">
                                </div>
                            </div>
                        </form>

                        <div v-show="error" class="form-group row div-error">
                            <div class="text-center text-error">

                                <div v-for="error in errorMessages"
                                     :key="error">
                                    <ol>
                                        <li v-text="error"></li>
                                    </ol>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button @click="closeModal()"
                                class="btn btn-secondary">
                            Close
                        </button>

                        <button @click="createOrUpdate(actionType)"
                                v-text="actionType"
                                class="btn btn-primary"
                        ></button>

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

    </main>

</template>

<script>
    export default {
        data() {

            return {

                categories: [],
                model: 'category',
                actionType: '',

                pagination: {

                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0

                },
                offset: 3,

                criteria: 'name',
                search: '',

                category_id: 0,
                name: '',
                description: '',

                modal: 0,
                modalTitle: '',

                error: 0,
                errorMessages: []

            }

        },
        methods: {

            showModal(action, data = []) {

                if (action === 'create') {

                    this.modal = 1
                    this.modalTitle = 'Create ' + this.capitalizeFirstLetter(this.model)
                    this.actionType = 'Save'
                    this.name = ''
                    this.description = ''

                }

                if (action === 'update') {

                    this.actionType = 'Update'
                    this.modal = 1
                    this.modalTitle = 'Update ' + this.capitalizeFirstLetter(this.model)

                    this.category_id = data.id
                    this.name = data.name
                    this.description = data.description

                }

            },
            closeModal() {

                this.modal = 0
                this.modalTitle = ''
                this.name = ''
                this.description = ''
                this.error = 0
                this.errorMessages = []

            },
            createOrUpdate(actionType) {

                if (actionType === 'Save') {

                    if (this.validate()) {
                        return;
                    }

                    axios.post('/api/categories', {

                        'name': this.name,
                        'description': this.description

                    })
                        .then(res => {

                            this.closeModal()
                            this.categoryList(1, '', 'name')

                        })
                        .catch(err => {
                            console.log(err)
                        })

                }

                if (actionType === 'Update') {

                    if (this.validate()) {
                        return;
                    }

                    axios.put(`/api/categories/${this.category_id}`, {

                        'name': this.name,
                        'description': this.description

                    })
                        .then(res => {

                            this.closeModal()
                            this.categoryList(1, '', 'name')

                        })
                        .catch(err => {
                            console.log(err)
                        })

                }

            },
            toggleStatus(category) {

                let action = category.status ? 'deactivate it!' : 'activate it!'

                swal({
                    title: 'Are you sure?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, ' + action

                })
                    .then((res) => {

                        if (res.value) {

                            console.log(category)

                            axios.put(`/api/categories/${category.id}/toggle-status`)
                                .then(res => {

                                    this.categoryList(1, '', 'name')

                                    swal(
                                        'Done!',
                                        'success'
                                    )

                                })
                                .catch(err => {
                                    console.log(err)
                                })

                        }

                    })

            },
            validate() {

                this.error = 0
                this.errorMessages = []

                if (!this.name) {

                    this.errorMessages.push('Category Name is required')

                }

                if (this.description.length > 255) {

                    this.errorMessages.push('Description can\'t be no more than 255 characters long.')

                }

                if (this.errorMessages.length) {

                    this.error = 1;

                }

                return this.error;

            },
            categoryList(page, search, criteria) {

                let url = '/api/categories?page=' + page
                    + '&search=' + search
                    + '&criteria=' + criteria

                axios.get(url)

                    .then(res => {

                        console.log(res.data.data.data)

                        this.categories = res.data.data.data
                        this.pagination = res.data.pagination

                    })

                    .catch(err => {

                        console.log(err)

                    })

            },
            capitalizeFirstLetter(string) {

                return string.charAt(0).toUpperCase() + string.slice(1);

            },
            paginate(page, search, criteria) {

                this.pagination.current_page = page

                this.categoryList(page, search, criteria)

            }

        },
        computed: {

            isActivated() {

                return this.pagination.current_page

            },
            pageNumber() {

                if (!this.pagination.to) {
                    return [];
                }

                let from = this.pagination.current_page - this.offset
                if (from < 1) {
                    from = 1;
                }

                let to = from + (this.offset * 2)
                if (to >= this.pagination.last_page) {

                    to = this.pagination.last_page

                }

                let pagesArray = []
                while (from <= to) {

                    pagesArray.push(from)
                    from++

                }

                return pagesArray

            }

        },
        mounted() {

            this.categoryList(
                1,
                this.search,
                this.criteria
            )

        }
    }
</script>

<style scoped>

    .table {

        text-align: center;
        vertical-align: middle;

    }

    .show {

        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;

    }

    .modal-content {

        width: 100% !important;
        position: absolute !important;

    }

    .div-error {

        display: flex;
        justify-content: center;

    }

    .text-error {

        color: red !important;
        font-weight: bold;

    }

</style>
