
<template>
 <footer class="footer">
    <div class="footer__logo">
      <img src="/path/to/logo.png" alt="Logo">
      <p class="footer__tagline">As a creative agency we work with you to develop solutions.</p>
      <div class="footer__social-media">
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
    <div class="footer__menu">
      <router-link :to="{ name: 'Home' }">Home</router-link>
      <router-link :to="{ name: 'JobBoards' }">Job Boards</router-link>
      <router-link :to="{ name: 'Talents' }">Talents</router-link>
      <router-link :to="{ name: 'Portfolio' }">Portfolio</router-link>
    </div>
    <div class="footer__help">
      <a href="#">Contact Us</a>
      <a href="#">FAQs</a>
      <a href="#">Terms of Service</a>
      <a href="#">Privacy & Policy</a>
    </div>
</footer>
</template>

<style scoped>
.footer {
  background-color: #1C74F4;
  color: #fff;
  padding: 40px 20px;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
}

.footer__logo {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  margin-bottom: 20px;
}

.footer__logo img {
  height: 40px;
}

.footer__tagline {
  font-size: 1rem;
  margin: 10px 0;
}

.footer__social-media {
  display: flex;
}

.footer__social-media a {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 30px;
  height: 30px;
  margin-right: 10px;
  color: #fff;
  background-color: #555;
  border-radius: 50%;
  text-decoration: none;
}

.footer__social-media a:hover {
  background-color: #777;
}

.footer__menu {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  margin-bottom: 20px;
}

.footer__menu a {
  font-size: 1rem;
  margin: 10px;
  text-decoration: none;
  color: #fff;
  transition: opacity 0.2s ease-in-out;
}

.footer__menu a:hover {
  opacity: 0.7;
}

.footer__help {
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-end;
}

.footer__help a {
  font-size: 1rem;
  margin: 10px;
  text-decoration: none;
  color: #fff;
  transition: opacity 0.2s ease-in-out;
}

.footer__help a:hover {
  opacity: 0.7;
}
</style>
