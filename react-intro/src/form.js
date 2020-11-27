import React from 'react';
//  import ReactDOM from 'react-dom';

class SkillsForm extends React.Component {
    handleSubmit = this.handleSubmit.bind(this);
    handleDelete = this.handleDelete.bind(this);

    state = {
        fieldValue: '',
        fieldsCount: 0,
        fields: [],
        skills: [],
    };

    handleSubmit(event) {
        const skill = event.target[0].value;
        console.log("Skill добавлен: ", skill);
        this.setState({
            skills: [...this.state.skills, skill],
        });
        this.setState({
            fields: [...this.state.fields, this.addField(skill)]
        });
        event.target[0].value = '';
        event.preventDefault();
      }
    addField(skill) {
        this.setState({
            fieldsCount: this.state.fieldsCount + 1
        });
        
        return (
            <div id={this.state.fieldsCount}>
                <span>{skill}</span>
                <button className="delete" type="submit" onClick={this.handleDelete}><img src='./images/png-computer-icons-vector-graphics-image-icon-design-i.jpg' alt=""></img></button>
            </div>
        );
    }

    handleDelete(event) {
        const id = event.target.parentNode.parentNode.id;
        this.setState({
            skills: this.state.skills.filter(el => el.id === id)
        });
        this.setState({
            fields: this.state.fields.filter(el => el.id === id)
        });
    }
    render() {
        const fields = []
        for (let i = 0; i < this.state.fieldsCount + 1; i++) {
            fields.push(this.state.fields[i]);
          }
        return (
            <div>
                <form onSubmit={this.handleSubmit}>
                <label>
                <input type="text" id="word" placeholder="Ввод ключевых слов" />
                </label>
                <button type="submit" className="submitButton">Найти</button>
                </form>
                <div id="skills">
                    {fields}
                </div>
            </div>
            );
        }
    }

export default SkillsForm; 
