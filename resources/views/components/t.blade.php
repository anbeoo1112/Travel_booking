@props(['key', 'default' => ''])

<span x-text="$store.uiTheme.t('{{ $key }}')">{{ $default }}</span>
