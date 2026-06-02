export default {
    extends: ['@commitlint/config-conventional'],

    rules: {
        // ─── Type ───────────────────────────────
        'type-enum': [
            2,
            'always',
            [
                'feat',
                'fix',
                'docs',
                'style',
                'refactor',
                'perf',
                'test',
                'ci',
                'chore',
                'revert',
            ],
        ],
        'type-case': [2, 'always', 'lower-case'],
        'type-empty': [2, 'never'],

        // ─── Scope ──────────────────────────────
        'scope-case': [2, 'always', 'lower-case'],
        'scope-enum': [0],

        // ─── Subject ────────────────────────────
        'subject-empty': [2, 'never'],
        'subject-case': [2, 'always', 'lower-case'],
        'subject-full-stop': [2, 'never', '.'],
        'subject-min-length': [2, 'always', 3],
        'subject-max-length': [2, 'always', 100],
    },
};
