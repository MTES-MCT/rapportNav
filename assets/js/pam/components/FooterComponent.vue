<template>
  <footer>
    <a href="#">Documentation</a>
    <a :href="mailto" v-if="mailto">Contact</a>
  </footer>
</template>

<script>
import axios from "axios";

export default {
  name: "FooterComponent",
  mounted() {
    let mailto = 'mailto:';
    let recipients = [];
    let copys = [];
    axios.get('/api/contacts').then((response) => {
      let contacts = response.data;
      contacts.forEach((contact) => {
        if(contact.isRecipient) {
          recipients.push(contact.email)
        }
        if(contact.isCopy) {
          copys.push(contact.email)
        }
      })

      recipients.forEach((recipient, index) => {
        if(index > 0) {
          mailto = mailto + ',' + recipient;
        } else {
          mailto = mailto + recipient;
        }
      })

      copys.forEach((copy, index) => {
        if(index > 0) {
          mailto = mailto + ',' + copy;
        } else {
          mailto = mailto + '?cc=' + copy;
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
