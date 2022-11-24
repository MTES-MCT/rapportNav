<template>
  <footer>
    <a href="#">Documentation</a>
    <a :href="'mailto:' + mailto" v-if="mailto">Contact</a>
  </footer>
</template>

<script>
import axios from "axios";

export default {
  name: "FooterComponent",
  mounted() {
    let mailto = null;
    axios.get('/api/contacts').then((response) => {
      let contacts = response.data;
      contacts.forEach((contact) => {
        if(contact.isRecipient) {
          mailto = contact.email;
        }
        if(contact.isCopy) {
          mailto = mailto + '?cc=' + contact.email;
        }
      })

      this.mailto = mailto;
    })
  },
  data() {
    return {
      mailto: null
    }
  }
}
</script>

<style scoped>

</style>
