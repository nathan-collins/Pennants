define([], function() {
  return {
    season: {
      add: {
        path: 'season/add',
        title: 'Add Season'
      },
      edit: {
        path: 'season/:seasonId/edit',
        title: 'Edit Season'
      }
    },
    grade: {
      add: {
        path: 'grade/add',
        title: 'Add Grade'
      },
      edit: {
        path: 'grade/:gradeId/edit',
        title: 'Edit Grade'
      }
    }
  }
});