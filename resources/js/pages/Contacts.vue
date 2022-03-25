<template>
  <div>
    <h1>Contatti</h1>

    <div v-if="!formSubmitted">
      <div class="mb-3">
        <label for="exampleFormControlInput2" class="form-label"
          >Nome / Cognome</label
        >
        <input
          type="text"
          class="form-control"
          id="exampleFormControlInput2"
          placeholder="Nome Cognome"
          v-model="formData.name"
        />
        <span
          class="text-danger"
          v-if="formValidationErrors && formValidationErrors.name"
          >{{ formValidationErrors.name }}</span
        >
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label"
          >Indirizzo Email</label
        >
        <input
          type="email"
          class="form-control"
          id="exampleFormControlInput1"
          placeholder="name@example.com"
          v-model="formData.email"
        />
        <span
          class="text-danger"
          v-if="formValidationErrors && formValidationErrors.email"
          >{{ formValidationErrors.email }}</span
        >
      </div>
      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label"
          >Messaggio</label
        >
        <textarea
          class="form-control"
          id="exampleFormControlTextarea1"
          rows="3"
          v-model="formData.message"
        ></textarea>
        <span
          class="text-danger"
          v-if="formValidationErrors && formValidationErrors.message"
          >{{ formValidationErrors.message }}</span
        >
      </div>

      <!-- Attachment -->
      <div class="mb-3">
        <label for="exampleFormControlInput3" class="form-label"
          >Allegato</label
        >
        <input
          type="file"
          class="form-control"
          id="exampleFormControlInput3"
          @change="onAttachmentChange"
        />
        <span
          class="text-danger"
          v-if="formValidationErrors && formValidationErrors.attachment"
          >{{ formValidationErrors.attachment }}</span
        >
      </div>

      <div>
        <button type="submit" class="btn btn-primary" @click="formSubmit">
          Invia!
        </button>
      </div>
    </div>

    <div v-else class="alert alert-success py-5">
      <h4>Grazie per averci contattato.</h4>
      <p class="lead">
        La sua richiesta è stata inviata correttamente e risponderemo il prima
        possibile.
      </p>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      formSubmitted: false,
      formData: {
        name: "",
        email: "",
        message: "",
        attachment: null,
      },
      formValidationErrors: null,
    };
  },
  methods: {
    async formSubmit() {
      try {
        this.formValidationErrors = null;
        const formDataInstance = new FormData();
        formDataInstance.append("name", this.formData.name);
        formDataInstance.append("email", this.formData.email);
        formDataInstance.append("message", this.formData.message);
        if (this.formData.attachment) {
          formDataInstance.append("attachment", this.formData.attachment);
        }
        const resp = await axios.post("/api/contacts", formDataInstance);
        // resp.data;
        this.formSubmitted = true;
      } catch (er) {
        // 422 = errore di validazione
        if (er.response.status === 422) {
          this.formValidationErrors = er.response.data.errors;
        }
        alert(
          "A causa di un errore non è stato possibile inviare la sua richiesta.\n\n" +
            er.response.data.message
        );
      }
    },
    onAttachmentChange(event) {
      this.formData.attachment = event.target.files[0];
    },
  },
};
</script>

<style></style>