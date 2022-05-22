<template>
    <div class="account-form">
        <h3>Đăng kí tài khoản</h3>
        <div class="form-group">
            <label for="">Bạn là ai?</label>
            <div class="role-grid">
                <div class="role">
                    <span>Sinh viên</span>
                    <input type="radio" id="customer" name="role" value="customer" v-model="data.role">
                    <label for="customer">
                        <span></span>
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="">Tên đầy đủ</label>
            <input type="text" v-model="data.name" class="form-control" placeholder="Nguyễn văn A" />
        </div>

        <div class="form-group">
            <label for="">Email</label>
            <input type="text" v-model="data.email" class="form-control" placeholder="username@gmail.com" />
        </div>
        
        <div class="form-group">
            <label for="">Mật khẩu</label>
            <input type="password" v-model="data.password" class="form-control" placeholder="**********" />
        </div>

        <div class="form-group">
            <button class="btn btn-main-gradient btn-block" @click="$emit('eventact', {eventType: 'signup'})">Đăng kí</button>
        </div>
    </div>
</template>

<script>
export default {
    props: ['data'],
    name: 'Register'
}
</script>