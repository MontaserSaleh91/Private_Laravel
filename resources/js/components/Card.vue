<template>
  <div class="card">
    <div class="card-header">
      <div class="card-title h5">
        <slot name="title"></slot>
      </div>
      <div class="card-subtitle text-gray">
        <slot name="subtitle"></slot>
      </div>
    </div>
    <div class="card-body">
      <slot name="body"></slot>
    </div>
    <div class="card-footer">
      <slot name="button"></slot>
    </div>
  </div>
</template>
