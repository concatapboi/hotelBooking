<template>
	<v-app>
		<v-navigation-drawer style="border: 1px solid yellow;" app></v-navigation-drawer>
		<v-toolbar app style="border: 1px solid green;"></v-toolbar>
		<v-content style="border: 1px solid blue;">
			<v-container style="border: 1px solid red;" fluid>
				<div style="border: 1px solid black;">
				<router-link tag="li" to="/home">Home</router-link>
				<router-link tag="li" to="/about">About</router-link>
				</div>
				<router-view>a</router-view>
			</v-container>
		</v-content>
		<v-footer app></v-footer>
	</v-app>
</template>
<script>
	export default {};
</script>