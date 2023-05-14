<template>
  <div class="st-input">
    <div class="st-input__body">
      <st-label v-if="props.label" :value="props.label" color="gray"/>
      <div v-if="props.type === 'number'" class="st-input__input">
        <input v-model="value" type="number" min="0" 
            :placeholder= "placeholder ? placeholder : 'Введите число...'"
            @input="$emit('update:modelValue', $event.target.value)"
        >
      </div>
      <div v-if="props.type === 'phone'" class="st-input__input">
        <input v-model="value" type="string" 
            pattern="/^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/"
            :class="{unvalid: !isValidPhone(new RegExp(/^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/))}"
            :placeholder= "placeholder ? placeholder : 'Введите номер телефона'"
             @input="$emit('update:modelValue', $event.target.value)"
        >
      </div>
      <div v-else-if="props.type === 'password'" class="st-input__input">
        <input v-model="value" type="password"
            pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$/"
            :class="{unvalid: !isValidPhone(new RegExp(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$/))}"
            :placeholder= "placeholder ? placeholder :  'Введите пароль...'"
            @input="$emit('update:modelValue', $event.target.value)"
        >
      </div>
      <div v-else-if="props.type === 'email'" class="st-input__input">
        <input v-model="value" type="email" 
            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
            :placeholder= "placeholder ? placeholder : 'Введите email...'"
            :class="{unvalid: !isValidPhone(new RegExp(/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/))}"
            @input="$emit('update:modelValue', $event.target.value)"
        >
      </div>
      <div v-else class="st-input__input">
        <input v-model="value" type="text"
            :placeholder= "placeholder ? placeholder : 'Введите текст...'"
            @input="$emit('update:modelValue', $event.target.value)"
        >
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from "vue";

const props = defineProps({
  label: String | Number | undefined,
  type: 'number' | 'text' | 'phone' | 'email' | 'password',
  placeholder: String | undefined,
  modelValue: String,
});
const emit = defineEmits(['update:modelValue', 'valid']);
const value = ref();

function isValidPhone(pattern) {
    const isValid = pattern.test(value.value);
    emit('valid', isValid);
    return isValid;
};

</script>

<style scoped lang="scss">
.st-input {
  display: flex;
  justify-content: center;
  align-content: center;

  &__body {
    .st-label {
      font-size: $--st-font-small;
    }
  }

  &__input {
    font-size: 1.6rem;
    line-height: 2rem;

    input {
      border: none;
      background-color: transparent;
      padding: $--st-offset-xs;

      border-bottom: .2rem solid $--st-black;
    }

    input:focus {
      outline: none;
    }
  }
}

.unvalid {
    color: red;
    background-color: red;        
}
</style>
