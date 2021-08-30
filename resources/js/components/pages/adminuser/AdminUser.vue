<template>
    <div>
        <div class="content">
            <div class="container-fluid">
                <!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
                <div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
                    <p class="_title0">Users <Button @click="addModal=true" class="float-right"><icon type="md-add" />Add Category</Button></p>
                    <div class="_overflow _table_div">
                        <table class="_table">
                            <!-- TABLE TITLE -->
                            <tr>
                                <th>#Id</th>
                                <th>Category Name</th>
                                <th>Icon Image</th>
                                <th>User Role</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            <!-- TABLE TITLE -->
                            <!-- ITEMS -->
                            <tr v-for="(user, i) in users" :key="i" v-if="users.length">
                                <td>{{ i+1 }}</td>
                                <td class="">{{user.userName}}</td>
                                <td><img :src="`${user.iconImage}`" style="width: 125px; height: 50px;*/" alt=""></td>
                                <th><span class="badge badge-info">{{ user.userRole }}</span></th>
                                <td>{{ user.created_at|dateFormat }}</td>
                                <td>
                                    <Button v-model="editData.id" type="success" @click="showEditModal(user)"><Icon type="md-pricetags"/></Button>
                                    <Button type="error" @click="deleteUser(user.id)"><Icon type="md-trash"/></Button>
                                </td>
                            </tr>
                            <!-- ITEMS -->
                        </table>
                    </div>
                </div>

                <Modal
                    v-model="addModal"
                    title="Add User"
                    :mask-closable="false"
                    :closable="false"
                >
                    <div class="space">
                        <Input type="text" v-model="data.userName" placeholder="Enter valid user name..." />
                    </div>
                    <div class="space">
                        <Input type="email" v-model="data.email" placeholder="Email example@mail.com" />
                    </div>
                    <div class="space">
                        <Input type="password" v-model="data.password" placeholder="Enter your password" />
                    </div>
                    <div class="space">
                        <Select v-model="data.userRole" placeholder="~~Select User Role~~">
                            <Option value="supperAdmin">Supper Admin</Option>
                            <Option value="admin">Admin</Option>
                            <Option value="user">User</Option>
                            <Option value="editor">Editor</Option>
                        </Select>
                    </div>

                    <Upload
                        ref="uploads"
                        type="drag"
                        :headers="{'x-csrf-token': token, 'X-Requested-With' : 'XMLHttpRequest'}"
                        :on-success="handleSuccess"
                        :on-error="handleError"
                        :format="['jpg','jpeg','png', 'svg']"
                        :max-size="2048"
                        :on-format-error="handleFormatError"
                        :on-exceeded-size="handleMaxSize"
                        action="/app/user-image/upload">
                        <div style="padding: 20px 0">
                            <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                            <p>Click or drag files here to upload</p>
                        </div>
                    </Upload>
                    <div class="demo-upload-list" v-if="data.iconImage">
                        <img :src="`${data.iconImage}`" alt="">
                        <div class="demo-upload-list-cover">
                            <Icon type="ios-trash-outline" @click="deleteImage()"></Icon>
                        </div>
                    </div>

                    <div slot="footer">
                        <Button type="primary" @click="addCategory()"  :disabled="isAdding" :loading="isAdding">{{isAdding ? 'Adding...' : 'Add Category'}}</Button>
                        <Button type="default" @click="addModal=false">close</Button>
                    </div>
                </Modal>


                <Modal
                    v-model="editModal"
                    title="Edit Category"
                    :mask-closable="false"
                    :closable="false"
                >
                    <Input v-model="editData.category_name" placeholder="Enter something..." />

                    <div class="space"></div>
                    <Upload v-show="isIconImage"
                        ref="uploads"
                        type="drag"
                        :headers="{'x-csrf-token': token, 'X-Requested-With' : 'XMLHttpRequest'}"
                        :on-success="handleSuccess"
                        :on-error="handleError"
                        :format="['jpg','jpeg','png']"
                        :max-size="2048"
                        :on-format-error="handleFormatError"
                        :on-exceeded-size="handleMaxSize"
                        action="/app/category-image/upload">
                        <div style="padding: 20px 0">
                            <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                            <p>Click or drag files here to upload</p>
                        </div>
                    </Upload>
                    <div class="demo-upload-list" v-if="editData.iconImage">
                        <img :src="`${editData.iconImage}`" alt="">
                        <div class="demo-upload-list-cover">
                            <Icon type="ios-trash-outline" @click="deleteImage(false)"></Icon>
                        </div>
                    </div>

                    <div slot="footer">
                        <Button type="primary" @click="updateCategory()"  :disabled="isAdding" :loading="isAdding">{{isAdding ? 'Adding...' : 'Edit Category'}}</Button>
                        <Button type="default" @click="editModal=false">close</Button>
                    </div>
                </Modal>

            </div>
        </div>
    </div>
</template>

<script>

export default {
    name:'AdminUser',
    data () {
        return {
            data: {
                iconImage : "",
                userName: "",
                email: '',
                password:'',
                userRole:'',
                token: "",
            },
            addModal: false,
            editModal: false,
            isAdding: false,
            users : [],
            editData: {
                iconImage : "",
                category_name: "",
                token: "",
            },
            isIconImage: false,
        }
    },
    methods: {
        clearDataProperty(){
            this.data.iconImage = ""
            this.data.userName = ""
            this.data.email = ""
            this.data.password = ""
            this.data.userRole = ""
            this.data.token = ""
            this.$refs.uploads.clearFiles()
        },
        async addCategory(){
            if (this.data.userName.trim() == "") return this.e('User name is Required','Opps')
            if (this.data.email.trim() == "") return this.e('Email address is Required','Opps')
            if (this.data.password.trim() == "") return this.e('Password is Required','Opps')
            if (this.data.userRole.trim() == "") return this.e('User Role is Required','Opps')
            // if (this.data.iconImage.trim() == "") return this.e('Category Image is Required','Opps')
            let res = await this.callApi('post', '/app/add-user', this.data);
            if (res.status === 200){
                this.addModal = false
                this.s('User Added Successfully Done...', 'Success');
                this.clearDataProperty();
                this.allUser()
            }else{
                this.swr('Have an error. please try again.');
            }
        },
        async allUser(){
            let res = await this.callApi('get', '/app/all-user');
            if (res.status === 200){
                this.users = res.data
            }else{
                this.swr('Something is wrong.');
            }

        },
        async showEditModal(cat){
            let catObj = {
                category_name : cat.category_name,
                iconImage : cat.iconImage,
                id: cat.id
            }
            this.editData = catObj
            this.editModal = true
        },
        async updateCategory(){
            if (this.editData.category_name.trim() == "") return this.e('Category name is Required','Opps')
            if (this.editData.iconImage.trim() == "") return this.e('Category Image is Required','Opps')
            let res = await this.callApi('post', 'app/update-cateogry', this.editData)
            if (res.status === 200){
                this.editModal = false
                this.allUser()
                this.editData.category_name = ""
                this.editData.iconImage = ""
                this.data.iconImage = ""
                this.$refs.uploads.clearFiles()
                this.s('Category update successully done...', 'Success');
            }else{
                this.swr('Something is woring.. ');
            }

        },
        async deleteUser(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#52b6ff',
                cancelButtonColor: '#e85c5c',
                confirmButtonText: "Delete"
            }).then(async (result) => {
                if (result.isConfirmed) {
                    let res = await this.callApi('post', 'app/delete-user', {'id':id})
                    if (res.status === 200){
                        this.s('User Deleted Successfully Done...', 'Success')
                        this.allUser()
                    }else{
                        this.swr('Something is wrong. Please Try again');
                    }
                }
            })
        },
        handleSuccess (res, file) {
            this.data.iconImage = res
            this.editData.iconImage = res
        },
        handleError (res, file) {
            this.e(file.errors.file.length ? file.errors.file : "Somthing want wrong...!",'Error')
        },
        handleFormatError (file) {
            this.$Notice.warning({
                title: 'The file format is incorrect',
                desc: 'File format of ' + file.name + ' is incorrect, please select jpg or png.'
            });
        },
        handleMaxSize (file) {
            this.$Notice.warning({
                title: 'Exceeding file size limit',
                desc: 'File  ' + file.name + ' is too large, no more than 2M.'
            });
        },
        async deleteImage(ishow=true){
            if (ishow != true){
                this.isIconImage = true
                this.editData.iconImage = "";
                this.$refs.uploads.clearFiles();
            }
            let imageName = this.data.iconImage;
            this.data.iconImage = "";
            this.$refs.uploads.clearFiles();
            var res = await this.callApi('post', 'app/user/delete-image', {image:imageName});
            if (res.status != 200){
                this.data.iconImage = imageName;
                this.swr('Something Wont Wrong..');
            }
        }
    },
    mounted(){
        this.allUser();
    },
    created() {
        this.token = window.Laravel.csrfToken
    },
}
</script>
