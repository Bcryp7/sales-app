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
                    Articles

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
                                       @keyup.enter="articleList(1, search, criteria)"
                                       type="text"
                                       class="form-control"
                                       placeholder="Search...">

                                <button type="submit"
                                        @click="articleList(1, search, criteria)"
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
                            <th>Code</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Description</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr v-for="article in articles"
                            :key="article.id">
                            <td>
                                <button @click="showModal('update', article)"
                                        class="btn btn-warning btn-sm">
                                    <i class="icon-pencil"></i>
                                </button>

                                <button @click="toggleStatus(article)"
                                        :class="[
                                            'btn',
                                            'btn-sm',
                                            article.status ?
                                                'btn-danger' :
                                                'btn-success'
                                        ]">
                                    <i :class="[
                                            article.status ?
                                                'icon-trash' :
                                                'icon-check'
                                        ]"></i>
                                </button>

                            </td>
                            <td v-text="article.code"></td>
                            <td v-text="article.name"></td>
                            <td v-text="article.category"></td>
                            <td v-text="article.price"></td>
                            <td v-text="article.stock"></td>
                            <td v-text="article.description"></td>
                            <td>
                                <div>

                                    <span v-if="article.status == 1"
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

                            <div class="row">

                                <!-- Category -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>
                                            Category
                                        </label>
                                        <select v-model="articleData.category_id"
                                                class="form-control">
                                            <option :value="articleData.category_id"
                                                    v-text="articleData.category"
                                                    disabled
                                                    selected
                                            ></option>
                                            <option v-for="category in categories"
                                                    :key="category.id"
                                                    :value="category.id" v-text="category.name"
                                            ></option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Name -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>
                                            Name
                                        </label>
                                        <input type="text"
                                               v-model="articleData.name"
                                               class="form-control"
                                               placeholder="Article Name...">
                                    </div>
                                </div>

                                <!-- Price -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>
                                            Price
                                        </label>
                                        <input type="number"
                                               v-model="articleData.price"
                                               class="form-control">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-4">
                                    <!-- Stock -->
                                    <div class="form-group">
                                        <label>
                                            Stock
                                        </label>
                                        <input type="number"
                                               v-model="articleData.stock"
                                               class="form-control">
                                    </div>
                                </div>

                                <!-- Code -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>
                                            Code
                                        </label>
                                        <input type="text"
                                               v-model="articleData.code"
                                               class="form-control"
                                               placeholder="Article code...">
                                    </div>

                                    <barcode :value="articleData.code"
                                             :options="{ format: 'EAN-13' }"
                                    >Generating Code Bar</barcode>

                                </div>

                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label>
                                            Description
                                        </label>
                                        <input type="text"
                                               v-model="articleData.description"
                                               class="form-control"
                                               placeholder="Enter Description...">
                                    </div>
                                </div>

                            </div>

                        </form>

                        <div v-show="error" class="form-group row div-error">
                            <div class="alert alert-danger text-error">

                                <div v-for="error in errorMessages"
                                     :key="error">
                                    <ul>
                                        <li v-text="error" class="pull-left"></li>
                                    </ul>
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
    import VueBarcode from 'vue-barcode'

    export default {
        data() {

            return {

                articles: [],
                model: 'article',
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

                articleData: [],
                article_id: 0,
                categories: [],

                modal: 0,
                modalTitle: '',

                error: 0,
                errorMessages: []

            }

        },
        methods: {

            showModal(action, data = []) {

                this.categoryList()

                if (action === 'create') {

                    this.modal = 1
                    this.modalTitle = 'Create ' + this.capitalizeFirstLetter(this.model)
                    this.actionType = 'Save'
                    this.articleData = []

                }

                if (action === 'update') {

                    this.actionType = 'Update'
                    this.modal = 1
                    this.modalTitle = 'Update ' + this.capitalizeFirstLetter(this.model)

                    this.article_id = data.id
                    this.articleData.category_id = data.category_id
                    this.articleData.category = data.category
                    this.articleData.code = data.code
                    this.articleData.name = data.name
                    this.articleData.price = data.price
                    this.articleData.stock = data.stock
                    this.articleData.description = data.description

                }

            },
            closeModal() {

                this.modal = 0
                this.modalTitle = ''
                this.error = 0
                this.errorMessages = []
                this.articleData = []

            },
            createOrUpdate(actionType) {

                if (actionType === 'Save') {

                    if (this.validate()) { return; }

                    axios.post('/api/articles', {

                        'category_id': this.articleData.category_id,
                        'code': this.articleData.code,
                        'name': this.articleData.name,
                        'price': this.articleData.price,
                        'stock': this.articleData.stock,
                        'description': this.articleData.description

                    })
                        .then(res => {

                            this.closeModal()
                            this.articleList(1, '', 'name')

                        })
                        .catch(err => {
                            console.log(err)
                        })

                }

                if (actionType === 'Update') {

                    if (this.validate()) { return; }

                    axios.put(`/api/articles/${this.article_id}`, {

                        'category_id': this.articleData.category_id,
                        'code': this.articleData.code,
                        'name': this.articleData.name,
                        'stock': this.articleData.stock,
                        'price': this.articleData.price,
                        'description': this.articleData.description

                    })
                        .then(res => {

                            this.closeModal()
                            this.articleList(1, '', 'name')

                        })
                        .catch(err => {
                            console.log(err)
                        })

                }

            },
            toggleStatus(article) {

                let action = article.status ? 'deactivate it!' : 'activate it!'

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

                            axios.put(`/api/articles/${article.id}/toggle-status`)
                                .then(res => {

                                    this.articleList(1, '', 'name')

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

                if (! this.articleData.category_id) this.errorMessages.push('Category is required')
                if (! this.articleData.code) this.errorMessages.push('Code is required')
                if (! this.articleData.name) this.errorMessages.push('Article Name is required')
                if (! this.articleData.price) this.errorMessages.push('Price is required')
                if (! this.articleData.stock) this.errorMessages.push('Stock is required')

                if (this.articleData.description.length > 255)
                    this.errorMessages.push('Description can\'t be no more than 255 characters long.')

                if (this.errorMessages.length) this.error = 1

                return this.error;

            },
            articleList(page, search, criteria) {

                let url = '/api/articles?page=' + page
                    + '&search=' + search
                    + '&criteria=' + criteria

                axios.get(url)

                    .then(res => {

                        this.articles = res.data.data
                        this.pagination = res.data.pagination

                    })

                    .catch(err => {

                        console.log(err)

                    })

            },
            categoryList() {

                axios.get('/api/categories/filters')

                    .then(res => {

                        this.categories = res.data.data

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

                this.articleList(page, search, criteria)

            }

        },
        computed: {

            isActivated() {

                return this.pagination.current_page

            },
            pageNumber() {

                if (! this.pagination.to) { return []; }

                let from = this.pagination.current_page - this.offset
                if (from < 1) { from = 1; }

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
        components: {
            'barcode': VueBarcode
        },
        mounted() {

            this.articleList(

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
        font-weight:bold;

    }

</style>
