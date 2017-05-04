<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Staffs extends Admin_Controller
{

    public $filter = [
        'filter_search'   => '',
        'filter_group'    => '',
        'filter_location' => '',
        'filter_date'     => '',
        'filter_status'   => '',
    ];

    public $default_sort = ['staffs.date_added', 'DESC'];

    public $sort = ['staff_name', 'staff_group_name', 'location_name', 'date_added', 'staff_id'];

    public function __construct()
    {
        parent::__construct(); //  calls the constructor

        $this->load->model('Staffs_model');
        $this->load->model('Locations_model'); // load the locations model
        $this->load->model('Staff_groups_model');

        $this->lang->load('staffs');
    }

    public function index()
    {
        $this->user->restrict('Admin.Staffs');

        if ($this->input->post('delete') AND $this->_deleteStaff() === TRUE) {
            $this->redirect();
        }

        $this->template->setTitle($this->lang->line('text_title'));
        $this->template->setHeading($this->lang->line('text_heading'));
        $this->template->setButton($this->lang->line('button_new'), ['class' => 'btn btn-primary', 'href' => page_url().'/edit']);
        $this->template->setButton($this->lang->line('button_delete'), ['class' => 'btn btn-danger', 'onclick' => 'confirmDelete();']);;
        $this->template->setButton($this->lang->line('button_icon_filter'), ['class' => 'btn btn-default btn-filter pull-right', 'data-toggle' => 'button']);

        $data = $this->getList();

        $this->template->render('staffs', $data);
    }

    public function edit()
    {
        if ($this->user->getStaffId() !== $this->input->get('id')) {
            $this->user->restrict('Admin.Staffs');
        }

        $staff_info = $this->Staffs_model->getStaff((int)$this->input->get('id'));
        $user_info = $this->Staffs_model->getStaffUser($staff_info['staff_id']);

        $username = isset($user_info['username']) ? $user_info['username'] : '';
        if ($this->input->post() AND $staff_id = $this->_saveStaff($staff_info['staff_email'], $username)) {
            $this->redirect($staff_id);
        }

        $title = (isset($staff_info['staff_name'])) ? $staff_info['staff_name'] : $this->lang->line('text_new');
        $this->template->setTitle(sprintf($this->lang->line('text_edit_heading'), $title));
        $this->template->setHeading(sprintf($this->lang->line('text_edit_heading'), $title));
        $this->template->setButton($this->lang->line('button_save'), ['class' => 'btn btn-primary', 'onclick' => '$(\'#edit-form\').submit();']);

        if ($this->user->hasPermission('Admin.Staffs.Access')) {
            $this->template->setButton($this->lang->line('button_save_close'), ['class' => 'btn btn-default', 'onclick' => 'saveClose();']);
        }

        $this->template->setButton($this->lang->line('button_icon_back'), ['class' => 'btn btn-default', 'href' => site_url('staffs')]);

        $data = $this->getForm($staff_info, $user_info);

        $this->template->render('staffs_edit', $data);
    }

    public function autocomplete()
    {
        $json = [];

        if ($this->input->get('term')) {
            $filter['staff_name'] = $this->input->get('term');
            $filter['staff_id'] = $this->input->get('staff_id');

            $results = $this->Staffs_model->getAutoComplete($filter);
            if ($results) {
                foreach ($results as $result) {
                    $json['results'][] = [
                        'id'   => $result['staff_id'],
                        'text' => utf8_encode($result['staff_name']),
                    ];
                }
            } else {
                $json['results'] = ['id' => '0', 'text' => $this->lang->line('text_no_match')];
            }
        }

        $this->output->set_output(json_encode($json));
    }

    public function getList()
    {
        if ($data['user_strict_location'] = $this->user->isStrictLocation()) {
            $this->setFilter('filter_location', $this->user->getLocationId());
        }

        $data = array_merge($this->getFilter(), $this->getSort(), $data);

        $data['staffs'] = [];
        $results = $this->Staffs_model->paginateWithFilter($this->getFilter());
        foreach ($results->list as $result) {
            $data['staffs'][] = array_merge($result, [
                'date_added' => day_elapsed($result['date_added']),
                'edit'       => $this->pageUrl($this->edit_url, ['id' => $result['staff_id']]),
            ]);
        }

        $data['pagination'] = $results->pagination;

        $data['staff_groups'] = $this->Staff_groups_model->dropdown('staff_group_name');

        $this->load->model('Locations_model');
        $data['locations'] = $this->Locations_model->isEnabled()->dropdown('location_name');

        $data['staff_dates'] = $this->Staffs_model->getStaffDates();

        return $data;
    }

    public function getForm($staff_info, $user_info)
    {
        $data = $staff_info;

        $staff_id = 0;
        $data['_action'] = $this->pageUrl($this->create_url);
        if (!empty($staff_info['staff_id'])) {
            $staff_id = $staff_info['staff_id'];
            $data['_action'] = $this->pageUrl($this->edit_url, ['id' => $staff_id]);
        }

        $data['display_staff_group'] = FALSE;
        if ($this->user->hasPermission('Admin.StaffGroups.Manage')) {
            $data['display_staff_group'] = TRUE;
        }

        $data['username'] = isset($user_info['username']) ? $user_info['username'] : '';

        $data['staff_groups'] = $this->Staff_groups_model->dropdown('staff_group_name');

        $this->load->model('Locations_model');
        $data['locations'] = $this->Locations_model->isEnabled()->dropdown('location_name');

        return $data;
    }

    protected function _saveStaff($staff_email, $username)
    {
        if ($this->validateForm($staff_email, $username) === TRUE) {
            $save_type = (!is_numeric($this->input->get('id'))) ? $this->lang->line('text_added') : $this->lang->line('text_updated');
            if ($staff_id = $this->Staffs_model->saveStaff($this->input->get('id'), $this->input->post())) {
                $action = ($this->input->get('id') == $this->user->getStaffId()) ? $save_type.' their' : $save_type;
                $message_lang = ($this->input->get('id') == $this->user->getStaffId()) ? 'activity_custom_no_link' : 'activity_custom';
                $item = ($this->input->get('id') == $this->user->getStaffId()) ? 'details' : $this->input->post('staff_name');

                log_activity($this->user->getStaffId(), $action, 'staffs', get_activity_message($message_lang,
                    ['{staff}', '{action}', '{context}', '{link}', '{item}'],
                    [$this->user->getStaffName(), $action, 'staff', current_url(), $item]
                ));

                $this->alert->set('success', sprintf($this->lang->line('alert_success'), 'Staff '.$save_type));
            } else {
                $this->alert->set('warning', sprintf($this->lang->line('alert_error_nothing'), $save_type));
            }

            return $staff_id;
        }
    }

    protected function _deleteStaff()
    {
        if ($this->input->post('delete')) {
            $deleted_rows = $this->Staffs_model->deleteStaff($this->input->post('delete'));
            if ($deleted_rows > 0) {
                $prefix = ($deleted_rows > 1) ? '['.$deleted_rows.'] Staffs' : 'Staff';
                $this->alert->set('success', sprintf($this->lang->line('alert_success'), $prefix.' '.$this->lang->line('text_deleted')));
            } else {
                $this->alert->set('warning', sprintf($this->lang->line('alert_error_nothing'), $this->lang->line('text_deleted')));
            }

            return TRUE;
        }
    }

    protected function validateForm($staff_email = FALSE, $username = FALSE)
    {
        $rules[] = ['staff_name', 'lang:label_name', 'xss_clean|trim|required|min_length[2]|max_length[128]'];

        if ($staff_email !== $this->input->post('staff_email')) {
            $rules[] = ['staff_email', 'lang:label_email', 'xss_clean|trim|required|max_length[96]|valid_email|is_unique[staffs.staff_email]'];
        }

        if ($username !== $this->input->post('username')) {
            $rules[] = ['username', 'lang:label_username', 'xss_clean|trim|required|is_unique[users.username]|min_length[2]|max_length[32]'];
        }

        $rules[] = ['password', 'lang:label_password', 'xss_clean|trim|min_length[6]|max_length[32]|matches[password_confirm]'];
        $rules[] = ['password_confirm', 'lang:label_confirm_password', 'xss_clean|trim'];

        if (!$this->input->get('id')) {
            $rules[] = ['password', 'lang:label_password', 'xss_clean|trim|required|min_length[6]|max_length[32]|matches[password_confirm]'];
            $rules[] = ['password_confirm', 'lang:label_confirm_password', 'xss_clean|trim|required'];
        }

        if ($this->user->hasPermission('Admin.StaffGroups.Manage')) {
            $rules[] = ['staff_group_id', 'lang:label_group', 'xss_clean|trim|required|integer'];
            $rules[] = ['staff_location_id', 'lang:label_location', 'xss_clean|trim|integer'];
        }

        $rules[] = ['staff_status', 'lang:label_status', 'xss_clean|trim|integer'];

        return $this->form_validation->set_rules($rules)->run();
    }
}

/* End of file Staffs.php */
/* Location: ./admin/controllers/Staffs.php */