<template>
	<div>
		<h3 class="mb-2 float-left">List of users</h3>
		<div class="pagination float-right">
			<button class="btn btn-default" v-on:click="fetchPaginateUsers(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">
				Previous
			</button>
			<span>Page {{ pagination.current_page }} of {{ pagination.last_page }}</span>
			<button class="btn btn-default" v-on:click="fetchPaginateUsers(pagination.next_page_url)" :disabled="!pagination.next_page_url">
				Next
			</button>
		</div>
		<table class="table col-12">
			<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Email</th>
				<th>Added in</th>
				<th>Last login</th>
				<th>Edit</th>
			</tr>
			</thead>
			<tbody>
			<tr v-for="user in users" :key="user.id">
				<td>{{ user.id }}</td>
				<td>{{ user.name }}</td>
				<td>{{ user.email }}</td>
				<td>{{ user.created_at.date }}</td>
				<td>{{ user.last_login }}</td>
				<td><a v-bind:href="user.url">Edit</a></td>
			</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
	export default {
		name: "AdminUsers",
		data() {
			return {
				users: [],
				pagination: [],
				url: "/api/users",
				param: "",
			}
		},
		methods: {
			loadUsers() {
				let $this = this;

				axios.get(this.url).then(data => {
						this.users = data.data.data;
						$this.makePagination(data.data);
					}
				);
			},
			makePagination(data) {
				let pagination = {
					current_page: data.meta.current_page,
					last_page: data.meta.last_page,
					next_page_url: data.links.next,
					prev_page_url: data.links.prev
				};

				this.pagination = pagination;
			},
			fetchPaginateUsers(url){
				this.url = url;
				this.loadUsers();
			},
		},
		created() {
			this.loadUsers();
		}
	}
</script>

<style scoped>

</style>