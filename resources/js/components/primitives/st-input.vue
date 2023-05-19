<template>
  <div class="st-input">
    <div class="st-input__body">
      <st-label v-if="props?.label" :value="props?.label" color="gray"/>
      <div v-if="props.type === 'number'" class="st-input__input">
        <input 
            type="number" 
            min="0" 
            v-model="modelValue"
            :placeholder= "placeholder ? placeholder : 'Введите число...'"
            @input="updateValue"
        >
      </div>
      <div v-else-if="props.type === 'phone'" class="st-input__input">
        <input 
            type="string"
            v-model="modelValue" 
            pattern="/^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/"
            :class="{unvalid: !(new RegExp(/^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/).test(props.modelValue))}"
            :placeholder= "placeholder ? placeholder : 'Введите номер телефона'"
            @input="isValid($event, new RegExp(/^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/))"
        >
      </div>
      <div v-else-if="props.type === 'password'" class="st-input__input">
        <input 
            type="password"
            v-model="modelValue"  
            pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$/"
            :class="{unvalid: !(new RegExp(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$/).test(props.modelValue))}"
            :placeholder= "placeholder ? placeholder :  'Введите пароль...'"
            @input="isValid($event, new RegExp(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$/))"
        >
      </div>
      <div v-else-if="props.type === 'email'" class="st-input__input">
        <input 
            type="email" 
            v-model="modelValue"  
            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
            :placeholder= "placeholder ? placeholder : 'Введите email...'"
            :class="{unvalid: !(new RegExp(/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/).test(props.modelValue))}"
            @input="isValid($event, new RegExp(/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/))"
        >
      </div>
      <div v-else class="st-input__input">
        <input 
            type="text"
            v-model="modelValue"
            :placeholder= "placeholder ? placeholder : 'Введите текст...'"
            @input="updateValue"
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
    modelValue: '',
});
const emit = defineEmits(['update:modelValue', 'valid']);

function isValid(event, pattern) {  
    updateValue(event);
    const isValid = pattern.test(props.modelValue);
    emit('valid', isValid);
    return isValid;
};

function updateValue(event) {
    emit('update:modelValue', event.target.value)
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

      border-bottom: 1px solid $--st-black;
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
